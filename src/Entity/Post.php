<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity()]
#[ORM\Table(name: "post")]
class Post
{
	#[ORM\Id()]
	#[ORM\GeneratedValue(strategy: "AUTO")]
	#[ORM\Column(type: "integer")]
	private int $id;

	#[ORM\Column(type: "string", nullable: false, length: 100)]
	private ?string $title = NULL;
  
	#[ORM\Column(type: "string", nullable: true, length: 350)]
	private string $content;

	#[ORM\Column(type: "string", nullable: true)]  
	private ?string $image = NULL;

	#[ORM\ManyToOne(targetEntity: "App\Entity\User", inversedBy: "posts")]
	private $user;

	public function getId()
	{
		return $this->id;
	}
	
	public function setId(int $id): self
	{
		$this->id = $id;
		return $this;
	}

	public function getTitle()
	{
		return $this->title;
	}

	public function setTitle($title):self
	{
		$this->title = $title;

		return $this;
	}

	public function getContent()
	{
		return $this->content;
	}

	public function setContent($content):self
	{
		$this->content = $content;
	
		return $this;
	}	

	public function getImage()
	{
		return $this->image;
	}

	public function setImage($image):self
	{
		$this->image = $image;

		return $this;
	}
/*
  public function getUser()
  {
	return $this->user;
  }

  public function setUser($user)
  {
	$this->user = $user;

	return $this;
  }*/
}