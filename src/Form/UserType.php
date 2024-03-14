<?php

/* este formulario ha sido generado con el comando php bin/console make:form. En la línea de comandos, el framework te pide: 
     - el nombre del formulario (por convención, los formularios termina en styles
     - la entidad a la cual vas arelacionarlo : vincula los datos del formulario con la entidad
     - crea la carpeta form y guarda dentro el fichero userType
 */
namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserType extends AbstractType         // Esta clase, UserType, extiende AbstractType, que es una clase base proporcionada por Symfony para definir formularios.
{
    public function buildForm(FormBuilderInterface $builder, array $options)   //buildForm(): Este método se utiliza para construir el formulario. Recibe dos argumentos: $builder, que es un objeto FormBuilderInterface utilizado para agregar campos al formulario, y $options, que es un array que contiene las opciones del formulario.
$builder                                                                          // En este método, se utilizan métodos encadenados en el $builder para agregar los campos del formulario. Estos campos son:
    {                                                                             // El método ->add('email', EmailType::class) es parte de la construcción de un formulario utilizando Symfony en PHP. Permite agregar un campo de entrada de correo electrónico al formulario.
        ->add('email', EmailType::class)                                          // 'email': Un campo de tipo EmailType, que se utiliza para capturar direcciones de correo electrónico.
            ->add('password', PasswordType::class)                                // 'password': Un campo de tipo PasswordType, que se utiliza para capturar contraseñas.
        ->add('nombre')                                                           // 'nombre': Un campo simple sin tipo específico, que se utilizará para capturar el nombre del usuario. 
            ->add('Registrar', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)                    //configureOptions(): Este método se utiliza para configurar las opciones del formulario. Recibe un argumento $resolver, que es un objeto OptionsResolver utilizado para definir las opciones del formulario.
    {
        $resolver->setDefaults([
            'data_class' => User::class,                                            //En este caso, se establece la opción 'data_class' en User::class, lo que indica que el formulario se vinculará a una instancia de la clase User. Esto significa que cuando el formulario se envíe, los datos se guardarán en un objeto User.
        ]);
    }
}
