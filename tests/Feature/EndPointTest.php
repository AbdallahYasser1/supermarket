<?php

namespace Tests\Feature;

use App\Models\customer;
use App\Models\product;
use App\Models\sales;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class EndPointTest extends TestCase
{
    use RefreshDatabase;

    private $PREFIX = 'api';

    public function setUp(): void
    {
        parent::setUp();

        $admin = User::factory()->create();
        $this->actingAs($admin);
    }

    /**
     * A basic feature test example.
     *
     * @return void
     */
    //    public function test_root()
    //    {
    //        $response = $this->get('/');
    //
    //        $response->assertStatus(404);
    //    }

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_register()
    {
        $name = 'test';
        $email = 'test@example.com';
        $password = '1234';
        $response = $this->post('api/register', ['name' => $name, 'email' => $email, 'password' => $password, 'password_confirmation' => $password]);

        $response->assertStatus(201);

        $content = $response->json();
        $this->assertEquals($content['user']['name'], $name);
        $this->assertEquals($content['user']['email'], $email);
    }

    public function test_login()
    {
        $email = "test@example.com";
        $password = '1234';
        $user = User::factory()->create(['email' => $email, 'password' => bcrypt($password)]);

        //        info("--------". $user->email ."--------". $password ."--------". $user->password);

        $response = $this->post('api/login', ['email' => $email, 'password' => $password]);
        $response->assertStatus(201);
    }

    public function test_login_unauthorized()
    {
        $email = "test@example.com";
        $password = '1234';
        $user = User::factory()->create(['email' => $email, 'password' => bcrypt($password)]);

        $response = $this->post('api/login', ['email' => $email, 'password' => '0']);
        $response->assertStatus(422);
    }

    public function test_createCustomer()
    {

        $data = [
            'name' => 'test',
            'address' => 'test',
            'phonenumber' => '011'
        ];
        $response = $this->post('api/customers', $data);
        $response->assertStatus(202);
    }

    // TODO Error
    public function test_updateCustomer()
    {
        $data = [
            'name' => 'test',
            'address' => 'test',
            'phonenumber' => '011'
        ];
        //        $customer = customer::factory()->create();
        $customer = customer::create($data);
        $newName = 'test2';
        $response = $this->put($this->PREFIX . '/customers/' . $customer->id, ['name' => $newName]);
        $response->assertStatus(200);
        //        $this->assertTrue(true);
    }

    public function test_deleteCustomer()
    {
        $data = [
            'name' => 'test',
            'email' => 'test@example.com',
            'password' => '1234',
            'address' => 'test',
            'phonenumber' => '011'
        ];
        //        $customer = customer::factory()->create();
        $customer = customer::create($data);
        $response = $this->delete($this->PREFIX . '/customers/' . $customer->id);
        $response->assertStatus(204);

        $this->expectException(ModelNotFoundException::class);
        $tmp = customer::findOrFail($customer->id);
    }

    public function test_addSale_success()
    {
        $data = [
            'name' => 'test',
            'quantity' => 5,
            'description' => "test",
            'price' => 5,
            'image' => 'test'
        ];

        $product = Product::create($data);

        $sale_data = ['product_id' => $product->id, 'quantity' => 4];
        //        $sale = sales::create($sale_data);

        $response = $this->post($this->PREFIX . "/sales", $sale_data);
        $response->assertStatus(202);
    }

    public function test_addSale_fail()
    {
        $data = [
            'name' => 'test',
            'quantity' => 5,
            'description' => "test",
            'price' => 5,
            'image' => 'test'
        ];

        $product = Product::create($data);

        $sale_data = ['product_id' => $product->id, 'quantity' => 6];
        //        $sale = sales::create($sale_data);

        $response = $this->post($this->PREFIX . "/sales", $sale_data);
        $response->assertStatus(202);
    }

    public function test_addProduct()
    {
        $data = [
            'name' => 'test',
            'quantity' => 5,
            'description' => "test",
            'price' => 5,
            'image' => 'test'
        ];

        $response = $this->post($this->PREFIX . "/products", $data);
        $response->assertStatus(202);
    }

    public function test_deleteProduct()
    {
        $data = [
            'name' => 'test',
            'quantity' => 5,
            'description' => "test",
            'price' => 5,
            'image' => 'test'
        ];
        $product = Product::create($data);

        $response = $this->delete($this->PREFIX . "/products/" . $product->id);
        $response->assertStatus(204);
    }

    public function test_updateProduct()
    {
        $data = [
            'name' => 'test',
            'quantity' => 5,
            'description' => "test",
            'price' => 5,
            'image' => 'test'
        ];
        $product = Product::create($data);

        $newName = 'test_new';
        $response = $this->put($this->PREFIX . "/products/" . $product->id, ['name' => $newName]);
        $response->assertStatus(200);
    }
}
