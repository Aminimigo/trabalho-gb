<?php
// Incluir a conexão com o banco de dados e as classes
require_once 'header.php';

?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sobre nós - CemFreelas</title>
    <link rel="stylesheet" href="style.css"> <!-- Certifique-se de que o caminho está correto -->
    <style>
        /* Estilos que você já forneceu */
        body {
            font-family: 'Roboto', sans-serif;
            background: linear-gradient(135deg, #4a6fa5, #a8d0e6);
            color: #333;
            padding: 0;
        }

        .container {
            max-width: 900px;
            margin: 0 auto;
            padding: 30px;
            background-color: #fff;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }

        h2 {
            font-size: 28px;
            color: blue;
        }

        p {
            font-size: 18px;
            line-height: 1.6;
            margin-bottom: 20px;
        }

        .contact-info, .social-links {
            font-size: 18px;
            margin-top: 30px;
        }

        .contact-info p, .social-links p {
            margin: 10px 0;
        }

        .social-links ul {
            list-style: none;
            padding: 0;
        }

        .social-links ul li {
            margin: 5px 0;
        }

        .social-links ul li a {
            color: #FF4D94;
            text-decoration: none;
            font-weight: 500;
        }

        .social-links ul li a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    
    <div class="container"> 
        <h2>Bem-vindo ao CemFreelas: A Plataforma Perfeita para Freelancers e Clientes!</h2>
        <p>O <strong>CemFreelas</strong> é um site inovador que conecta freelancers e clientes, proporcionando um ambiente dinâmico onde projetos podem ser propostos, contratados e avaliados de forma simples e segura. Se você é freelancer e busca novos desafios, ou se você é cliente em busca de profissionais para realizar seus projetos, o CemFreelas é o lugar certo para você!</p>

        <p>Nosso sistema é estruturado para atender a diferentes tipos de usuários, com funcionalidades voltadas para facilitar a criação de projetos, comunicação entre as partes e uma avaliação transparente das experiências. Abaixo, explicamos como o site funciona para cada tipo de usuário.</p>

        <h3>Para o Usuário:</h3>
        <p>Se você está visitando o CemFreelas pela primeira vez, seja como freelancer ou cliente, você pode criar uma conta de usuário com apenas alguns cliques. Com a conta criada, você pode acessar um painel personalizado para gerenciar seus dados, interagir com outros membros da plataforma e muito mais.</p>

        <h4>Funcionalidades:</h4>
        <ul>
            <li><strong>Cadastro e Login:</strong> O sistema de login permite que os usuários acessem a plataforma de maneira segura, podendo também recuperar a senha caso necessário.</li>
            <li><strong>Painel de Controle:</strong> Após o login, você terá acesso a um painel de controle onde pode atualizar suas informações, visualizar suas mensagens e acompanhar o progresso de seus projetos.</li>
        </ul>

        <h3>Para Freelancers:</h3>
        <p>Se você é um freelancer, o CemFreelas oferece um espaço para você propor projetos, definir preços, categorias e descrições, e se conectar com clientes em busca de profissionais qualificados. Os freelancers podem criar novos projetos a qualquer momento e acompanhar seu desempenho, seja atualizando as informações ou gerenciando a comunicação com os clientes.</p>

        <h4>Funcionalidades:</h4>
        <ul>
            <li><strong>Criação de Projetos:</strong> Freelancers podem criar novos projetos com informações detalhadas, como título, descrição, preço e categoria. Isso facilita a exposição do trabalho e atrai potenciais clientes.</li>
            <li><strong>Visualização de Projetos:</strong> Freelancers podem ver seus próprios projetos e modificar qualquer detalhe se necessário. A plataforma também permite que o freelancer gerencie todos os seus projetos em um único lugar.</li>
            <li><strong>Mensagens:</strong> Uma funcionalidade importante é a mensagem, onde os freelancers podem se comunicar diretamente com os clientes interessados em seus serviços, tirar dúvidas e negociar detalhes antes de iniciar o trabalho.</li>
        </ul>

        <h3>Para Clientes:</h3>
        <p>Clientes podem navegar por uma vasta lista de projetos disponíveis, seja para contratar freelancers para novos projetos ou comprar produtos relacionados a serviços de freelancers. O site oferece uma maneira fácil de visualizar os freelancers disponíveis, suas avaliações e projetos passados, ajudando a tomar decisões informadas.</p>

        <h4>Funcionalidades:</h4>
        <ul>
            <li><strong>Busca de Projetos:</strong> Clientes podem filtrar projetos por categoria, preço ou freelancer, facilitando a busca pelo profissional ideal para suas necessidades.</li>
            <li><strong>Mensagens:</strong> Os clientes também podem usar o sistema de mensagens para entrar em contato diretamente com os freelancers para discutir detalhes sobre os projetos ou negociar preços.</li>
            <li><strong>Avaliações:</strong> Após a conclusão do projeto, clientes podem deixar avaliações para os freelancers, ajudando outros clientes a escolher os melhores profissionais para suas necessidades.</li>
        </ul>

        <h3>Sistema de Avaliações:</h3>
        <p>O sistema de avaliações é um dos pontos fortes do CemFreelas. Ele permite que clientes e freelancers compartilhem suas experiências, criando um ambiente de confiança. Cada projeto realizado gera uma avaliação, onde tanto o cliente quanto o freelancer podem deixar notas e comentários sobre a colaboração.</p>

        <p>Essas avaliações são visíveis para outros membros da plataforma, o que ajuda a garantir que a qualidade e a transparência sejam mantidas, além de ajudar os novos usuários a escolher os melhores profissionais ou projetos.</p>

        <h4>Funcionalidades Extras:</h4>
        <ul>
            <li><strong>Segurança e Privacidade:</strong> O CemFreelas prioriza a segurança dos dados dos usuários. Todas as informações sensíveis, como senhas e dados de pagamento, são criptografadas para garantir a proteção e a privacidade de cada membro.</li>
            <li><strong>Interface Simples e Responsiva:</strong> A plataforma é totalmente responsiva, o que significa que você pode acessar e gerenciar seus projetos e interações de qualquer dispositivo, seja computador, tablet ou smartphone.</li>
        </ul>

        <h3>Como Funciona o CemFreelas?</h3>
        <p>A plataforma foi pensada para ser intuitiva e fácil de usar. Veja um resumo de como funciona:</p>
        <ol>
            <li><strong>Criação de Conta:</strong> Cadastre-se como freelancer ou cliente, criando uma conta rápida.</li>
            <li><strong>Propostas de Projetos:</strong> Freelancers podem criar e publicar projetos. Clientes podem navegar entre os projetos ou buscar freelancers para contratar.</li>
            <li><strong>Mensagens e Negociações:</strong> Use o sistema de mensagens para se comunicar, negociar preços e discutir detalhes do trabalho.</li>
            <li><strong>Avaliação:</strong> Ao concluir um projeto, você poderá deixar uma avaliação sobre a experiência. Isso ajuda a manter a qualidade e a confiança na plataforma.</li>
            <li><strong>Acompanhamento:</strong> Ambos, freelancers e clientes, podem acompanhar o andamento dos projetos, ver mensagens e manter tudo organizado em um painel de controle.</li>
        </ol>

        <h3>Conclusão:</h3>
        <p>O <strong>CemFreelas</strong> é a solução ideal para quem deseja conectar-se com profissionais qualificados ou para quem quer encontrar novos desafios na área de freelancing. Nossa plataforma proporciona uma experiência fluida e segura, onde tanto freelancers quanto clientes podem colaborar para realizar grandes projetos. Se você busca uma forma prática e confiável de trabalhar ou contratar, o CemFreelas é o lugar certo para você!</p>
    </div>

    <?php require_once '../header/footer.php'; ?> <!-- Correção aqui -->

</body>
</html>
