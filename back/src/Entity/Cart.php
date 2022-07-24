<?php

declare(strict_types=1);

namespace App\Entity;

use App\Repository\CartRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: CartRepository::class)]
class Cart
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column()]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank]
    #[Assert\Length(max: 255)]
    private string $name;

    #[ORM\Column]
    private bool $isSelected;

    public function __construct(string $name, bool $isSelected = false)
    {
        $this->name = $name;
        $this->isSelected = $isSelected;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function isSelected(): bool
    {
        return $this->isSelected;
    }

    public function setIsSelected(bool $isSelected): void
    {
        $this->isSelected = $isSelected;
    }
}
