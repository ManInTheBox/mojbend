<?php

/**
 * Email command which you can use with Yii's `yiic` command
 *
 * Command will query database every 10 seconds for not sent emails.
 * It will also check if email has reached max sending attempts.
 * This avoids possibility of trying to sent email that for some reason cannot
 * be sent. Emails are ordered by their priority.
 * If some error occurs, it will be logged in database.
 *
 * This command is complete solution for email system that never stops.
 * You have to install new cron job that will call this command every minute.
 * During that minute command will try to send not sent emails every 10 seconds.
 *
 * If command found invalid email (bounced email, non-existing MX record), it
 * will remove it from database.
 *
 * Command is also concurrency free. It will lock itself and not allow other
 * process(es) to use it until it finish its job.
 *
 * How to use it:
 *
 * Single usage - will run 1 minute:
 *
 * /path/to/yiic email
 *
 * As a cron job - will run forever (replace &#42; with *):
 * 
 * &#42;/1 * * * * /path/to/yiic email
 *
 * @author Zarko Stankovic <stankovic.zarko@gmail.com>
 */

class EmailCommand extends CConsoleCommand
{

    public function run($args)
    {
        $fp = fopen(dirname(__FILE__), 'r');
        if (flock($fp, LOCK_EX | LOCK_NB)) // lock itself
        {
            $start = microtime(true);

            for ($i = 0; $i <= 50; $i += 10)
            {
                // check if max execution time is reached
                if ((microtime(true) - $start) > 50)
                {
                    exit();
                }

                // get all not sent emails
                $mails = Email::model()->findAll(array(
                            'condition' => 'status = ' . Email::STATUS_NOT_SENT . ' AND sending_counter < ' . Email::MAX_SENDING_ATTEMPTS,
                            'order' => 'priority'
                        ));

                if ($mails != null) // we have a job here
                {
                    foreach ($mails as $mail)
                    {
                        // check if max execution time is reached
                        if ((microtime(true) - $start) > 55)
                        {
                            exit();
                        }

                        if (!$mail->validateAddress())
                        {
                            // we have invalid email (already bounced, invalid MX record...)
                            $mail->delete();
                        }
                        else
                        {
                            // update counter because we processed it once
                            $mail->saveCounters(array('sending_counter' => 1));
                            try
                            {
                                // send email to end user and update email details in database
                                $mail->processSending();
                                $mail->status = Email::STATUS_SENT;
                                $mail->sending_time = time();
                                $mail->save(false);
                            }
                            catch (Exception $ex)
                            {
                                // log error to database
                                $mail->error_message = $ex->getMessage();
                                $mail->save(false);
                            }
                        }
                    }
                }

                // check if max execution time is reached
                if ((microtime(true) - $start) > 50)
                {
                    exit();
                }

                // wait 10 seconds
                @time_sleep_until($start + ($i + 10));
            }

            flock($fp, LOCK_UN); // unlock itself
        }
        fclose($fp);
    }

}