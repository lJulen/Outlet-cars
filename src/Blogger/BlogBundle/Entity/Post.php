<?php
// src/Blogger/BlogBundle/Entity/Post.php
namespace Blogger\BlogBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
/**
 * Blogger\BlogBundle\Entity\Post
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Blogger\BlogBundle\Entity\PostRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class Post
{
	/**
	* @ORM\Id
	* @ORM\Column(type="integer")
	* @ORM\GeneratedValue(strategy="AUTO")
	*/
	protected $id;

	/**
	* @ORM\Column(type="text")
	*/
	protected $title;

	/**
	* @ORM\Column(type="text")
	*/
	protected $body;
	
	/**
	* @ORM\Column(type="date")
	*/
	protected $date;

	/**
	 * @ORM\OneToMany(targetEntity="Comment", mappedBy="post")
	 */
	private $comments;
	public function __construct()
	{
		$this->comments = new ArrayCollection();

		$this->setDate(new \DateTime());
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

    /**
     * Set title
     *
     * @param string $title
     * @return Post
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string 
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set body
     *
     * @param string $body
     * @return Post
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
	public function getBody($length = null)
	{
		if (false === is_null($length) && $length > 0 && strlen($this->body) > $length)
		return substr($this->body, 0, $length) . "(...)";
		else
		return $this->body;
	}

    /**
     * Set date
     *
     * @param \DateTime $date
     * @return Post
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime 
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Add comments
     *
     * @param \Blogger\BlogBundle\Entity\Comment $comments
     * @return Post
     */
    public function addComment(\Blogger\BlogBundle\Entity\Comment $comments)
    {
        $this->comments[] = $comments;

        return $this;
    }

    /**
     * Remove comments
     *
     * @param \Blogger\BlogBundle\Entity\Comment $comments
     */
    public function removeComment(\Blogger\BlogBundle\Entity\Comment $comments)
    {
        $this->comments->removeElement($comments);
    }

    /**
     * Get comments
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getComments()
    {
        return $this->comments;
    }
	public function __toString()
	{
		return $this->getTitle();
	}
}
