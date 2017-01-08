<?php
declare(strict_types=1);

namespace App\Entity;

use App\Service\Authorization\Role\AttendeeRole;
use App\Service\Authorization\Role\RoleFactory;
use App\Service\Authorization\Role\RoleInterface;
use App\Service\User\PasswordHashInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Ramsey\Uuid\Uuid;

/**
 * @ORM\Entity
 * @ORM\Table(name="`user`")
 */
/*final */class User
{
    /**
     * @ORM\Id
     * @ORM\Column(name="id", type="guid")
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $id;

    /**
     * @ORM\Column(name="email", type="string", length=1024, nullable=false, unique=true)
     * @var string
     */
    private $email;

    /**
     * @ORM\Column(name="password", type="string", length=1024, nullable=false)
     * @var string
     */
    private $password;

    /**
     * @ORM\Column(name="role", type="string", length=1024, nullable=false)
     * @var string
     */
    private $role;

    /**
     * @ORM\Column(name="display_name", type="string", length=1024, nullable=false)
     * @var string
     */
    private $displayName;

    /**
     * @ORM\ManyToMany(targetEntity=Meetup::class, mappedBy="attendees")
     * @var Meetup[]
     */
    private $meetupsAttended;

    private function __construct()
    {
        $this->id = Uuid::uuid4();
        $this->meetupsAttended = new ArrayCollection();
    }

    public static function new(
        string $email,
        string $displayName,
        PasswordHashInterface $algorithm,
        string $password
    ) : self {
        $instance = new self();
        $instance->email = $email;
        $instance->displayName = $displayName;
        $instance->password = $algorithm->hash($password);
        $instance->role = AttendeeRole::NAME;
        return $instance;
    }

    public function getEmail() : string
    {
        return $this->email;
    }

    public function displayName() : string
    {
        return $this->displayName;
    }

    public function verifyPassword(PasswordHashInterface $algorithm, string $password) : bool
    {
        if ('' === $this->password) {
            return false;
        }

        return $algorithm->verify($password, $this->password);
    }

    public function getRole() : RoleInterface
    {
        return RoleFactory::getRole($this->role);
    }

    public function isAttending(Meetup $meetup) : bool
    {
        return $this->meetupsAttended->contains($meetup);
    }

    public function meetupsAttended() : Collection
    {
        return $this->meetupsAttended;
    }
}
