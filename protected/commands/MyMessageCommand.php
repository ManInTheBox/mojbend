<?php

Yii::import('system.cli.commands.MessageCommand');

/**
 * Description of MyMessageCommand
 *
 * @author Zarko Stankovic <stankovic.zarko@gmail.com>
 */
class MyMessageCommand extends MessageCommand
{

    protected function extractMessages($fileName, $translator)
    {
        echo "Extracting messages from $fileName...\n";
        $subject = file_get_contents($fileName);

        // TODO: uraditi pattern
        $pattern = '/\b'.$translator.'\s*\(\s*(\'.*?(?<!\\\\)\'|".*?(?<!\\\\)")\s*,\s*(\'.*?(?<!\\\\)\'|".*?(?<!\\\\)")\s*[,\)]/s';

        $n = preg_match_all($pattern, $subject, $matches, PREG_SET_ORDER);
        $messages = array();
        for ($i = 0; $i < $n; ++$i)
        {
            if (($pos = strpos($matches[$i][1], '.')) !== false)
                $category = substr($matches[$i][1], $pos + 1, -1);
            else
                $category=substr($matches[$i][1], 1, -1);
            $message = $matches[$i][2];
            $messages[$category][] = eval("return $message;");  // use eval to eliminate quote escape
        }
        return $messages;
    }

    protected function generateMessageFile($messages, $fileName, $overwrite)
    {
        die('nema generisanja za sad...');
    }

}