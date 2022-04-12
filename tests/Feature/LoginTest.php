<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class LoginTest extends TestCase
{
    use RefreshDatabase;                                // RAZ la bdd entre chaques tests 

    /**
     * @test
     */
    public function when_a_user_gives_his_credentials_he_is_authenticated()
    {
        $this->withoutExceptionHandling();              // Ne pas catcher les exceptions pour nous permettre de lire les erreurs

        $user = User::factory()->create();

        $credentials = [
            'email' => $user->email,
            'password' => 'password'
        ];

        $this->post('/login', $credentials)             // On déclenche une requête POST vers /login avec les data email et password
            ->assertRedirect(route('dashboard'));       // On test la redirection vers dashboard

        $this->assertEquals(auth()->id(), $user->id);   // On test la correspondance entre le user logué et le user créé pour notre test
    }

    /**
     * @test
     */
    public function to_be_authenticated_a_user_must_give_valid_email()
    {
        $this->post('/login', ['email' => 'fake', 'password' => 'fake'])    // On pousse un email avec un mauvais format
            ->assertSessionHasErrors(keys: 'email');                        // On test que l'on obtient bien une erreur
    }

    /**
     * @test
     */
    public function to_be_authenticated_a_user_must_give_an_email_present_in_db()
    {
        $this->post('/login', ['email' => 'fake@hotmail.fr', 'password' => 'fake'])    // On pousse un email avec bon format mais qui n'existe pas en bdd
            ->assertSessionHasErrors(keys: 'email');                                   // On test que l'on obtient bien une erreur
    }


    /**
     * @test
     */
    public function authentication_requires_email()
    {
        $this->post('/login', ['email' => '', 'password' => 'fake'])                   // On pousse une valeur vide pour l'email
            ->assertSessionHasErrors(keys: 'email');
    }

    /**
     * @test
     */
    public function authentication_requires_password()
    {
        $this->post('/login', ['email' => '', 'password' => ''])                   // On pousse une valeur vide pour le password
            ->assertSessionHasErrors(keys: 'password');
    }

    /**
     * @test
     */
    public function to_be_authenticated_a_user_must_give_exact_password()
    {
        $user = User::factory()->create();                                  // On utilise factory pour créer un utilisateur
        $credentials = [                            
            'email' => $user->email,
            'password' => 'fake-password'                                   // On utilise des identifiants erronnés
        ];
    
        $this->post('/login', $credentials)->assertSessionHasErrors(keys: 'email');     // On attend une erreur
    }
}
