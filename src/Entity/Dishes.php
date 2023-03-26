<?php

namespace App\Entity;

use ApiPlatform\Doctrine\Orm\Filter\DateFilter;
use ApiPlatform\Metadata\ApiFilter;
use ApiPlatform\Metadata\ApiResource;
use App\Repository\DishesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use Doctrine\ORM\Mapping as ORM;
use EasyCorp\Bundle\EasyAdminBundle\Filter\TextFilter;
use Symfony\Component\Serializer\Annotation\Groups;

#[ApiResource(
    normalizationContext: ['groups' => ["Dishes:read:collection"]],
    operations: [
        new Get(
            normalizationContext: ['groups' => ["Dishes:read:item"]]
        ),
        new GetCollection()
    ]
    ),
    ApiFilter(DateFilter::class, properties: ['created_at']),
    
]
#[ORM\Entity(repositoryClass: DishesRepository::class)]
class Dishes
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;


    #[Groups(['Dishes:read:collection'])]
    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[Groups(['Dishes:read:collection'])]
    #[ORM\Column(type: Types::TEXT)]
    private ?string $description = null;


    #[Groups(['Dishes:read:collection'])]
    #[ORM\Column(length: 255)]
    private ?string $image = null;


    #[Groups(['Dishes:read:collection'])]
    #[ORM\Column]
    private ?int $price = null;

    #[Groups(['Dishes:read:collection'])]
    #[ORM\Column]
    private ?\DateTimeImmutable $created_at = null;

    #[Groups(['Dishes:read:collection'])]
    #[ORM\Column]
    private ?\DateTimeImmutable $updated_at = null;

    #[Groups(['Dishes:read:collection'])]
    #[ORM\Column]
    private ?bool $status = null;

    #[Groups(['Dishes:read:item'])]
    #[ORM\ManyToOne(inversedBy: 'dishes')]
    private ?Category $category = null;

    #[ORM\ManyToMany(targetEntity: Menu::class, mappedBy: 'dishes')]
    private Collection $menus;

    #[ORM\ManyToMany(targetEntity: Command::class, mappedBy: 'dishes')]
    private Collection $commands;

    

    
    public function __construct()
    {
        $this->menus = new ArrayCollection();
        $this->commands = new ArrayCollection();
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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(string $image): self
    {
        $this->image = $image;

        return $this;
    }

    public function getPrice(): ?int
    {
        return $this->price;
    }

    public function setPrice(int $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->created_at;
    }

    public function setCreatedAt(\DateTimeImmutable $created_at): self
    {
        $this->created_at = $created_at;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeImmutable
    {
        return $this->updated_at;
    }

    public function setUpdatedAt(\DateTimeImmutable $updated_at): self
    {
        $this->updated_at = $updated_at;

        return $this;
    }

    public function isStatus(): ?bool
    {
        return $this->status;
    }

    public function setStatus(bool $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function getCategory(): ?Category
    {
        return $this->category;
    }

    public function setCategory(?Category $category): self
    {
        $this->category = $category;

        return $this;
    }

    
    public function __toString()
    {
        return $this->name;
    }

    /**
     * @return Collection<int, Menu>
     */
    public function getMenus(): Collection
    {
        return $this->menus;
    }

    public function addMenu(Menu $menu): self
    {
        if (!$this->menus->contains($menu)) {
            $this->menus->add($menu);
            $menu->addDish($this);
        }

        return $this;
    }

    public function removeMenu(Menu $menu): self
    {
        if ($this->menus->removeElement($menu)) {
            $menu->removeDish($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, Command>
     */
    public function getCommands(): Collection
    {
        return $this->commands;
    }

    public function addCommand(Command $command): self
    {
        if (!$this->commands->contains($command)) {
            $this->commands->add($command);
            $command->addDish($this);
        }

        return $this;
    }

    public function removeCommand(Command $command): self
    {
        if ($this->commands->removeElement($command)) {
            $command->removeDish($this);
        }

        return $this;
    }

    
}
