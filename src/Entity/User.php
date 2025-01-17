<?php

/*  Para crear esta entidad, se ejecuta en la consola el comando php bin/console make:entity de manera general.
    Para el caso particular de los users, se utiliza el mismo comando, pero cambiando user por entity. En la creación, la consola te pedirá :
    - el campo con el que querrás acceder : en este caso, el email.
    - si quieres hashear las contraseñas.
    Si necesitas añadir más campos, solo hay que copiar la sintaxis que transforman los campos en BDD. (como está hecho en baneado)
    Esto significa que las anotaciones que van entre /** no son comentarios, sino la sintaxis para decretar qué tipo de dato será en la base de datos. De esta forma, la entidad se transforma en tabla en la bDD
    Para actualizar la base de datos, se puede usar el comando php bin/console doctrine:schema:update --force

    
    Pregunta el nombre de la entidad que se quiere crear o modificar (User). Como la entidad existe, propone agregar campos nuevos : pregunta el tipo, longitud, si puede ser nulo y después propone otra agregación 
    Las anotaciones @ORM\Entity y @ORM\Id, @ORM\GeneratedValue, @ORM\Column se utilizan para mapear la clase User a una tabla de la base de datos y definir sus propiedades.
*/


namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 */
class User implements UserInterface   // : Las anotaciones @ORM\Entity y @ORM\Id, @ORM\GeneratedValue, @ORM\Column se utilizan para mapear la clase User a una tabla de la base de datos y definir sus propiedades.
{ 
    const REGISTRO_EXITOSO = 'Se ha registrado exitosamente';

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;                                                        // las lineas superiores determinan que este ID sea un entero, una columna, y se genere de manera automática y autoincrementable

    /**
     * @ORM\Column(type="string", length=180, unique=true)
     */
    private $email;                                                    // este será un string único, de longitud 180 char, una columna. Nota : el tipo texto no da límite de carácteres

    /**
     * @ORM\Column(type="json")
     */
    private $roles = [];

    /**
     * @var string The hashed password
     * @ORM\Column(type="string")
     */
    private $password;                                                  //En este caso, indica que esta propiedad almacena la contraseña del usuario de forma cifrada (hashed).                                                       

    /**
     * @ORM\Column(type="boolean")
     */
    private $baneado;


    /**
     * @ORM\Column(type="string")
     */
    private $nombre;
    
                                                                                    //  La anotación @ORM\OneToMany es una anotación de Doctrine ORM que se utiliza para establecer una relación de uno a muchos entre dos entidades en una base de datos relacional.
    /**                                                                                            
     * @ORM\OneToMany(targetEntity="App\Entity\Comentarios", mappedBy="user")
     */
                                                                                    //targetEntity="App\Entity\Comentarios": Este parámetro especifica la clase de la entidad objetivo con la que se está estableciendo la relación. En este caso, se refiere a la clase Comentarios en el espacio de nombres App\Entity.
                                                                                    //mappedBy="user": Este parámetro especifica el nombre de la propiedad en la entidad objetivo (Comentarios) que actúa como el lado inverso de la relación. En este caso, se refiere a la propiedad user en la clase Comentarios, que probablemente sea una propiedad que hace referencia a la entidad User.
    
    private $comentarios;                                                            //La declaración private $comentarios; define una propiedad de clase $comentarios, que se utilizará para almacenar una colección de comentarios asociados a un usuario.



    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Posts", mappedBy="user")
     */
    private $posts;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Profesion", mappedBy="user")
     */
    private $profesion;

    /**
     * User constructor.
     */
    public function __construct()
    {
        $this->baneado = false;
        $this->roles = ['ROLE_USER'];
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUsername(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getPassword(): string
    {
        return (string) $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getSalt()
    {
        // not needed when using the "bcrypt" algorithm in security.yaml
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    /**
     * @return mixed
     */
    public function getBaneado()
    {
        return $this->baneado;
    }

    /**
     * @param mixed $baneado
     */
    public function setBaneado($baneado): void
    {
        $this->baneado = $baneado;
    }

    /**
     * @return mixed
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * @param mixed $nombre
     */
    public function setNombre($nombre): void
    {
        $this->nombre = $nombre;
    }


}
