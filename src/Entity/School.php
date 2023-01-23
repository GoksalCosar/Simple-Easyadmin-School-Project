<?php

namespace App\Entity;

use App\Repository\SchoolRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SchoolRepository::class)]
class School
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $created_at = null;

    #[ORM\Column]
    private ?bool $isActive = null;

    #[ORM\OneToMany(mappedBy: 'school', targetEntity: Classes::class)]
    private Collection $classes;

    #[ORM\OneToMany(mappedBy: 'school', targetEntity: Lesson::class)]
    private Collection $lesson;

    public function __construct()
    {
        $this->classes = new ArrayCollection();
        $this->Lesson = new ArrayCollection();
        $this->lesson = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->created_at;
    }

    public function setCreatedAt(\DateTimeInterface $created_at): self
    {
        $this->created_at = $created_at;

        return $this;
    }

    public function isIsActive(): ?bool
    {
        return $this->isActive;
    }

    public function setIsActive(bool $isActive): self
    {
        $this->isActive = $isActive;

        return $this;
    }

    /**
     * @return Collection<int, Classes>
     */
    public function getClasses(): Collection
    {
        return $this->classes;
    }

    public function addClass(Classes $class): self
    {
        if (!$this->classes->contains($class)) {
            $this->classes->add($class);
            $class->setSchool($this);
        }

        return $this;
    }

    public function removeClass(Classes $class): self
    {
        if ($this->classes->removeElement($class)) {
            // set the owning side to null (unless already changed)
            if ($class->getSchool() === $this) {
                $class->setSchool(null);
            }
        }

        return $this;
    }

   public function __toString()
   {
       return $this->name;
   }

   /**
    * @return Collection<int, Lesson>
    */
   public function getLesson(): Collection
   {
       return $this->lesson;
   }

   public function addLesson(Lesson $lesson): self
   {
       if (!$this->lesson->contains($lesson)) {
           $this->lesson->add($lesson);
           $lesson->setSchool($this);
       }

       return $this;
   }

   public function removeLesson(Lesson $lesson): self
   {
       if ($this->lesson->removeElement($lesson)) {
           // set the owning side to null (unless already changed)
           if ($lesson->getSchool() === $this) {
               $lesson->setSchool(null);
           }
       }

       return $this;
   }
}
