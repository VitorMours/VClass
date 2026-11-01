# Notes 

##### 31/10/2026


Ao autenticar o usuário, é necessário que cuidados extras sejam tomados em alguns casos que temos de sistemas, um exemplo disso, é que dentro de sistemas que precisam de login, e o login é feito por meio de sessão e de cookie, temos que todas as rotas internas protegidas, exigem o cookie que identificação do usuário, de forma que quando ele for acessar elas, se não tiver corretao, o middleware de `AuthMiddleware` faz com que o usuário seja redirecinado para a rota de login, para que possa funcionar corretamente. Um exemplo disso, é que dentro da rota de logout, além de deletar os dados dentro do servidor, por meio do `session_destroy()`, temos que remover os dados do usuário para que não tenha nehum tipo de roubo de credenciais, limpando os dados de sessão, limpando completamente o `$_SESSION`, e limpando todos os cookies, além de expirar todos eles corretamente.

// Adicionar comentarios com os codigos de exemplo




#### 26/10/2026
- [ ] Corrigir o SMTP para mandar email para o usuario confirmar criacao de conta 
- [ ] Criar tabela dentro do banco de dados de confirmacao de criacao de conta
- [ ] Evnair email, e fazer adicao do id da sala dentro da tabela `class_student` 

##### 19/06/2026
- [x] FAzer atualização do sistema de desenvolvimento para adicionar o phinx para gerencimaneto de migracao de banco de dados 

