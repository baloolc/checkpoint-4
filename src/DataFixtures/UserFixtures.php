<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Filesystem\Filesystem;

class UserFixtures extends Fixture
{
    private UserPasswordHasherInterface $passwordHasher;

    public function __construct(UserPasswordHasherInterface $passwordHasher)
    {
        $this->passwordHasher = $passwordHasher;
    }

    public function load(ObjectManager $manager): void
    {
        $filesystem = new Filesystem();
        $filesystem->remove('public/uploads/user');
        $filesystem->mkdir('public/uploads/user');

        $admin = new User();
        $admin->setEmail('admin@magic.com');
        $admin->setRole(['ROLE_ADMIN']);
        $admin->setFirstname('Bilbo');
        $admin->setLastname('Baggins');
        $admin->setPseudo('admin');
        $admin->setAvatar('');
        $hashedPassword = $this->passwordHasher->hashPassword(
            $admin,
            'admin'
        );
        $admin->setPassword($hashedPassword);
        $manager->persist($admin);
        $this->addReference($admin->getEmail(), $admin);

        $user = new User();
        $user->setEmail('user@magic.com');
        $user->setRole(['ROLE_USER']);
        $user->setFirstname('Jean-Sebastien');
        $user->setLastname('De Mon-Miraille');
        $user->setPseudo('Kiki');
        $avatar = 'avatar' . 'png';
        copy('src/DataFixtures/avatar.png', 'public/uploads/user/' . $avatar);
        $user->setAvatar($avatar);
        $this->addReference($user->getEmail(), $user);
        $this->addReference('user_', $user);
        $hashedPassword = $this->passwordHasher->hashPassword(
            $user,
            'azerty'
        );
        $user->setPassword($hashedPassword);
        $manager->persist($user);
        $manager->flush();
    }
}
