<?php

namespace App\Entity;

use App\Entity\Property;
use Symfony\Component\Validator\Constraints as Assert;
// use Doctrine\Common\Collections\ArrayCollection;
// use Doctrine\Common\Collections\Collection;
// use Doctrine\ORM\Mapping as ORM;
// use Cocur\Slugify\Slugify;
// use Symfony\Component\HttpFoundation\File\File;
// use Symfony\Component\HttpFoundation\File\UploadedFile;
// use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
// use Vich\UploaderBundle\Mapping\Annotation as Vich;

class Contact
{

    /**
     *  @var string|null
     *  @Assert\NotBlank()
     *  @Assert\Length(min=2, max=100)
     */
     private $firstname;

    /**
     *  @var string|null
     *  @Assert\NotBlank()
     *  @Assert\Length(min=2, max=100)
     */
     private $lastname;

    /**
     *  @var string|null
     *  @Assert\NotBlank()
     *  @Assert\Regex(
     *   pattern="/[0-9]{10}/"
     *  )
     */
     private $phone;

     /**
      *  @var string|null
      *  @Assert\NotBlank()
      *  @Assert\Email
      */
      private $email;

      /**
      *  @var string|null
      *  @Assert\NotBlank()
      *  @Assert\Length(min=10)
      */
      private $message;

      /**
      *  @var Property|null
      *  @Assert\NotBlank()
      */
      private $property;


      public function getFirstname(): ?string
      {
          return $this->firstname;
      }

      public function setFirstname(string $firstname): Contact
      {
          $this->firstname = $firstname;

          return $this;
      }


      public function getLastname(): ?string
      {
          return $this->lastname;
      }

      public function setLastname(string $lastname): Contact
      {
          $this->lastname = $lastname;

          return $this;
      }


      public function getPhone(): ?string
      {
          return $this->phone;
      }

      public function setPhone(string $phone): Contact
      {
          $this->phone = $phone;

          return $this;
      }


      public function getEmail(): ?string
      {
          return $this->email;
      }

      public function setEmail(string $email): Contact
      {
          $this->email = $email;

          return $this;
      }


      public function getMessage(): ?string
      {
          return $this->message;
      }

      public function setMessage(string $message): Contact
      {
          $this->message = $message;

          return $this;
      }


      public function getProperty(): ?Property
      {
          return $this->property;
      }

      public function setProperty(Property $property): Contact
      {
          $this->property = $property;

          return $this;
      }


}
