<?php

namespace App\EventListener;

use App\Entity\Contact;
use Symfony\Component\Mime\Address;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\Mailer\MailerInterface;

class ContactListener
{

    protected $mailer;

    public function __construct(MailerInterface $mailer)
    {
        $this->mailer = $mailer;
    }

    public function prePersist(Contact $entity, LifecycleEventArgs $args)
    {
        $email = new TemplatedEmail();
        $email->to(new Address( $entity->getDepartment()->getEmail(), $entity->getDepartment()->getManager() ))
            ->from( $entity->getEmail() )
            ->subject( 'Fiche Contact' )
            ->htmlTemplate('emails/contactEmail.html.twig')
            ->context([
                'contact' => $entity,
            ]);

        $this->mailer->send($email);
    }
}