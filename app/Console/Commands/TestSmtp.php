<?php

namespace App\Console\Commands;

use App\Mail\TestSmtpMail;
use Illuminate\Console\Command;
use Illuminate\Mail\Message;
use Illuminate\Support\Facades\Mail;

class TestSmtp extends Command
{
    protected $signature = 'app:test-smtp {emailTo : адрес, куда отправить тестовое сообщение}';

    protected $description = 'Отправляет email-сообщение средствами приложения';

    public function handle(): int
    {
        $emailTo = $this->argument('emailTo');

        Mail::send(
            'emails.test-smtp',
            [],
            function (Message $message) use ($emailTo) {
                $message->to($emailTo);
                $message->subject('Тестовое письмо для проверки smtp сайта (синхронное)');
            }
        );

        Mail::to($emailTo)->send(new TestSmtpMail());

        return 0;
    }
}
