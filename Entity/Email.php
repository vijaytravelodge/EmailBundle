<?php

namespace c975L\EmailBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Email
 *
 * @ORM\Table(name="emails")
 * @ORM\HasLifecycleCallbacks()
 * @ORM\Entity
 */
class Email
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_sent", type="datetime", nullable=true)
     */
    protected $dateSent;

    /**
     * @var string
     *
     * @ORM\Column(name="subject", type="string", length=256, nullable=true)
     */
    protected $subject;

    /**
     * @var string
     *
     * @ORM\Column(name="sent_from", type="string", length=128, nullable=true)
     */
    protected $sentFrom;

    /**
     * @var string
     *
     * @ORM\Column(name="sent_to", type="string", length=128, nullable=true)
     */
    protected $sentTo;

    /**
     * @var string
     *
     * @ORM\Column(name="sent_cc", type="string", length=128, nullable=true)
     */
    protected $sentCc;

    /**
     * @var string
     */
    protected $sentBcc;

    /**
     * @var string
     */
    protected $replyTo;

    /**
     * @var string
     *
     * @ORM\Column(name="body", type="string", length=65000, nullable=true)
     */
    protected $body;

    /**
     * @var string
     *
     * @ORM\Column(name="ip", type="string", length=48, nullable=true)
     */
    protected $ip;

    protected $mailer;



    public function __construct()
    {
dump('eeeeeeeeeee');die;
        $this->setDateSent(new \DateTime());
    }


    public function setDataFromArray($data)
    {
        foreach ($data as $key => $value) {
            $function = 'set' . ucfirst($key);
            $this->$function($value);
        }
    }

    public function send()
    {
        if (\Swift_Validate::email($this->getSentTo())) {
            $message = (new \Swift_Message())
                ->setSubject($this->getSubject())
                ->setTo($this->getSentTo())
                ->setBody($this->getBody())
                ->setContentType('text/html');

            //Adds other address
            if ($this->getSentFrom() !== '' && \Swift_Validate::email($this->getSentFrom())) $message->setFrom($this->getSentFrom());
            if ($this->getSentCc() !== '' && \Swift_Validate::email($this->getSentCc())) $message->setCc($this->getSentCc());
            if ($this->getSentBcc() !== '' && \Swift_Validate::email($this->getSentBcc())) $message->setBcc($this->getSentBcc());
            if ($this->getReplyTo() !== '' && \Swift_Validate::email($this->getReplyTo())) $message->setReplyTo($this->getReplyTo());

            //Sends email
            $this->mailer->send($message);
        }
    }



    /**
     * Set mailer
     *
     * @param \DateTime $mailer
     *
     * @return Email
     */
    public function setMailer($mailer)
    {
        $this->mailer = $mailer;

        return $this;
    }

    /**
     * Get mailer
     *
     * @return \DateTime
     */
    public function getMailer()
    {
        return $this->mailer;
    }

    /**
     * Set dateSent
     *
     * @param \DateTime $dateSent
     *
     * @return Email
     */
    public function setDateSent($dateSent)
    {
        $this->dateSent = $dateSent;

        return $this;
    }

    /**
     * Get dateSent
     *
     * @return \DateTime
     */
    public function getDateSent()
    {
        return $this->dateSent;
    }

    /**
     * Set subject
     *
     * @param string $subject
     *
     * @return Email
     */
    public function setSubject($subject)
    {
        $this->subject = $subject;

        return $this;
    }

    /**
     * Get subject
     *
     * @return string
     */
    public function getSubject()
    {
        return $this->subject;
    }

    /**
     * Set sentFrom
     *
     * @param string $sentFrom
     *
     * @return Email
     */
    public function setSentFrom($sentFrom)
    {
        $this->sentFrom = $sentFrom;

        return $this;
    }

    /**
     * Get sentFrom
     *
     * @return string
     */
    public function getSentFrom()
    {
        return $this->sentFrom;
    }

    /**
     * Set sentTo
     *
     * @param string $sentTo
     *
     * @return Email
     */
    public function setSentTo($sentTo)
    {
        $this->sentTo = $sentTo;

        return $this;
    }

    /**
     * Get sentTo
     *
     * @return string
     */
    public function getSentTo()
    {
        return $this->sentTo;
    }

    /**
     * Set sentCc
     *
     * @param string $sentCc
     *
     * @return Email
     */
    public function setSentCc($sentCc)
    {
        $this->sentCc = $sentCc;

        return $this;
    }

    /**
     * Get sentCc
     *
     * @return string
     */
    public function getSentCc()
    {
        return $this->sentCc;
    }

    /**
     * Set sentBcc
     *
     * @param string $sentBcc
     *
     * @return Email
     */
    public function setSentBcc($sentBcc)
    {
        $this->sentBcc = $sentBcc;

        return $this;
    }

    /**
     * Get sentBcc
     *
     * @return string
     */
    public function getSentBcc()
    {
        return $this->sentBcc;
    }

    /**
     * Set replyTo
     *
     * @param string $replyTo
     *
     * @return Email
     */
    public function setReplyTo($replyTo)
    {
        $this->replyTo = $replyTo;

        return $this;
    }

    /**
     * Get replyTo
     *
     * @return string
     */
    public function getReplyTo()
    {
        return $this->replyTo;
    }

    /**
     * Set body
     *
     * @param string $body
     *
     * @return Email
     */
    public function setBody($body)
    {
        $this->body = $body;

        return $this;
    }

    /**
     * Get body
     *
     * @return string
     */
    public function getBody()
    {
        return $this->body;
    }

    /**
     * Set ip
     *
     * @param string $ip
     *
     * @return Email
     */
    public function setIp($ip)
    {
        $this->ip = $ip;

        return $this;
    }

    /**
     * Get ip
     *
     * @return string
     */
    public function getIp()
    {
        return $this->ip;
    }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }
}

