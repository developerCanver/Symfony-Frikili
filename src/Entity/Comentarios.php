<?php

namespace App\Entity;

use App\Repository\ComentariosRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ComentariosRepository::class)
 */
class Comentarios
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $comentario;

    /**
     * @ORM\Column(type="datetime")
     */
    private $fehca_publicacion;

        /* relacion de tablas 
        muchos comentarios pueder ser de un usuario
        MUCHOS  A UNO 
        ManytoOne
        se comoce por inversedBy
        */
        
    /**
    * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="comentarios")
    */
    /* nombre de la llave forane synfony agrega _id a user_id */
    private $user;

    /**
    * @ORM\ManyToOne(targetEntity="App\Entity\Posts", inversedBy="comentarios")
    */
    
    private $post;


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getComentario(): ?string
    {
        return $this->comentario;
    }

    public function setComentario(string $comentario): self
    {
        $this->comentario = $comentario;

        return $this;
    }

    public function getFehcaPublicacion(): ?\DateTimeInterface
    {
        return $this->fehca_publicacion;
    }

    public function setFehcaPublicacion(\DateTimeInterface $fehca_publicacion): self
    {
        $this->fehca_publicacion = $fehca_publicacion;

        return $this;
    }
}
