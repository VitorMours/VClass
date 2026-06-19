<?php
use PHPUnit\Framework\TestCase;
use App\Controllers\HomeController;



class HomeControllerTest extends TestCase{

    protected function setUP(): void {}


    public function test_deve_renderizar_a_tela_home_page_com_sucesso() {
        $controller = new HomeController();

    }
    
}



?>