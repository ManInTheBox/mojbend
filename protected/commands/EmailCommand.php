<?php

/**
 * Description of EmailCommand
 *
 * @author Zarko Stankovic <stankovic.zarko@gmail.com>
 */

class EmailCommand extends CConsoleCommand
{

    public function run($args)
    {
        $fp = fopen(dirname(__FILE__), 'r');
        if (flock($fp, LOCK_EX | LOCK_NB))
        {
            $start = microtime(true);

            for ($i = 0; $i <= 50; $i += 10)
            {
                if ((microtime(true) - $start) > 50)
                {
                    exit();
                }

                $mails = Email::model()->findAll(array(
                            'condition' => 'status = ' . Email::STATUS_NOT_SENT . ' AND sending_counter < ' . Email::MAX_SENDING_ATTEMPTS,
                            'order' => 'priority'
                        ));

                if ($mails != null)
                {
                    foreach ($mails as $mail)
                    {
                        if ((microtime(true) - $start) > 55)
                        {
                            exit();
                        }

                        if (!$mail->validateAddress())
                        {
                            $mail->delete();
                        }
                        else
                        {
                            $mail->saveCounters(array('sending_counter' => 1));
                            try
                            {
                                $mail->processSending();
                                $mail->status = Email::STATUS_SENT;
                                $mail->sending_time = time();
                                $mail->save(false);
                            }
                            catch (Exception $ex)
                            {
                                $mail->error_message = $ex->getMessage();
                                $mail->save(false);
                            }
                        }
                    }
                }

                if ((microtime(true) - $start) > 50)
                {
                    exit();
                }

                @time_sleep_until($start + ($i + 10));
            }

            flock($fp, LOCK_UN);
        }
        fclose($fp);
    }

}