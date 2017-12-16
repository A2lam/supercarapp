<?php

namespace A2\ImageBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * Image
 *
 * @ORM\Table(name="image")
 * @ORM\Entity(repositoryClass="A2\ImageBundle\Repository\ImageRepository")
 * @ORM\HasLifecycleCallbacks
 */
class Image
{
    /**
     * @var int
     *
     * @ORM\Column(name="imageId", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="imageExtension", type="string", length=255)
     */
    private $extension;

    /**
     * @var string
     *
     * @ORM\Column(name="imageAlt", type="string", length=255)
     */
    private $alt;

    private $file;

    private $path;

    // Etant donné que cet entité sera utilisé par user et voiture (du moins pour le moment)
    // On stock l'entité qui est en train de l'utilisé
    private $nature;

    // On ajoute cet attribut pour y stocker le nom du fichier temporairement
    private $tempFileName;

    /**
     * Image constructor.
     */
    public function __construct($nature)
    {
        $this->nature = $nature;
    }

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set extension
     *
     * @param string $extension
     *
     * @return Image
     */
    public function setExtension($extension)
    {
        $this->extension = $extension;

        return $this;
    }

    /**
     * Get extension
     *
     * @return string
     */
    public function getExtension()
    {
        return $this->extension;
    }

    /**
     * Set alt
     *
     * @param string $alt
     *
     * @return Image
     */
    public function setAlt($alt)
    {
        $this->alt = $alt;

        return $this;
    }

    /**
     * Get alt
     *
     * @return string
     */
    public function getAlt()
    {
        return $this->alt;
    }

    // On modifie le setter de $file, pour prendre en compte l'upload d'un fichier
    // lorsqu'il en existe déjà un autre
    public function setFile(UploadedFile $file)
    {
        $this->file = $file;

        // On vérifie si on avait déjà un fichier pour cet entité.
        if (null !== $this->extension)
        {
            // On sauvegarde l'extension du fichier pour le supprimer plus tard
            $this->tempFileName = $this->extension;

            // On réinitialise les valeurs des attributs url et alt
            $this->extension = null;
            $this->alt = null;
        }
    }

    public function getFile()
    {
        return $this->file;
    }

    public function setPath()
    {
        if ($this->nature == 'car')
            $this->path = $this->getCarImgDir(). '/' .$this->id. '.' .$this->extension;
        else
            $this->path = $this->getUserImgDir(). '/' .$this->id. '.' .$this->extension;
    }

    public function getPath()
    {
        return $this->path;
    }

    /**
     * Retourne le dossier de stockage des images de voitures
     */
    protected function getCarImgDir()
    {
        return __DIR__.'/../../../../web/uploads/img/car';
    }

    /**
     * Retourne le dossier de stockage des images des utilisateurs
     */
    protected function getUserImgDir()
    {
        return __DIR__.'/../../../../web/uploads/img/user';
    }

    /**
     * @ORM\PrePersist()
     * @ORM\PreUpdate()
     */
    public function preUpload()
    {
        // Si jamais il n'y a pas de fichier (champ facultatif), on ne fait rien
        if (null === $this->file)
        {
            return;
        }

        // Le nom du fichier est son id, on doit juste stocker également son extension
        $this->extension = $this->file->guessExtension();

        // Et on génère l'attribut alt de la balise <img>, à la valeur du nom du fichier
        // sur le PC de l'internaute
        $this->alt = $this->file->getClientOriginalName();
    }

    /**
     * @ORM\PostPersist()
     * @ORM\PostUpdate()
     */
    public function upload()
    {
        // S'il n'y a pas de fichier (champ facultatif), on ne fait rien
        if (null === $this->file)
        {
            return;
        }

        // On est vérifie la nature de k'image que l'on est en train de transférer, voiture ou utilisateur
        if ($this->nature == 'car')
        {
            // Sauvegarde d'une image de voiture

            // Si on avait un ancien fichier on le supprime
            if (null !== $this->tempFileName)
            {
                $oldFile = $this->getCarImgDir(). '/' .$this->id. '.' .$this->tempFileName;
                if (file_exists($oldFile))
                {
                    unlink($oldFile);
                }
            }

            // On déplace le fichier envoyé dans le répertoire de notre choix
            $this->file->move(
                $this->getCarImgDir(), // Le répertoire de destination
                $this->id. '.' .$this->extension // Le nom du fichier à crée, ici << id.extension >>
            );
        }
        else
        {
            // Sauvegarde d'une image d'utilisateur

            // Si on avait un ancien fichier on le supprime
            if (null !== $this->tempFileName)
            {
                $oldFile = $this->getUserImgDir(). '/' .$this->id. '.' .$this->tempFileName;
                if (file_exists($oldFile))
                {
                    unlink($oldFile);
                }
            }

            // On déplace le fichier envoyé dans le répertoire de notre choix
            $this->file->move(
                $this->getUserImgDir(), // Le répertoire de destination
                $this->id. '.' .$this->extension // Le nom du fichier à crée, ici << id.extension >>
            );
        }
    }

    /**
     * @ORM\PreRemove()
     */
    public function preRemoveUpload()
    {
        // Petite vérification sur la nature
        if ($this->nature == 'car')
        {
            // On sauvegarde temporairement le nom du fichier, car il dépend de l'id
            $this->tempFileName = $this->getCarImgDir(). '/' .$this->id. '.' .$this->extension;
        }
        else
            $this->tempFileName = $this->getUserImgDir(). '/' .$this->id. '.' .$this->extension;
    }

    /**
     * @ORM\PostRemove()
     */
    public function removeUpload()
    {
        // En PostRemove, on a pas accès à l'id, on utilise notre nom sauvegardé
        if (file_exists($this->tempFileName))
        {
            // On supprime le fichier
            unlink($this->tempFileName);
        }
    }
}