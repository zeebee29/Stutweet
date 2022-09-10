<?php

namespace App\Form;

use App\Entity\Post;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Url;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\NotNull;


class PostType extends AbstractType
{
  public function buildForm(FormBuilderInterface $builder, array $options)
  {
    $builder 
      ->add("title", TextType::class, [
        "label" => "Titre",
        "required" => true,
        "constraints" => [new Length([
                          "min" =>10,
                          "max" => 100,
                          "minMessage" => 'Votre titre doit faire plus de 10 caractères',
                          "maxMessage" => 'Votre titre doit faire moins de 100 caractères']),
                        new NotNull(["message" => 'Le titre doit être renseigné'])]
        ])
      ->add("content", TextareaType::class, [
        "label" => "Contenu",
        "required" => true,
        "constraints" => [new Length([
                          "min" =>10,
                          "max" => 350,
                          "minMessage" => 'Votre message doit faire plus de 10 caractères',
                          "maxMessage" => 'Votre message doit faire moins de 350 caractères']),
                          new NotBlank(["message" => 'Le contenu ne doit pas être vide'])]
      ])
      ->add("image", UrlType::class, [
        "label" => "url de l'image",
        "required" => false,
        "constraints" => [new Url(['message' => 'Il doit s\'agir de l\'url d\'une image'])],
      ]);
  }

  public function configureOptions(OptionsResolver $resolver)
  {
    $resolver->setDefaults(["data_class" => Post::class]);
  }
}

