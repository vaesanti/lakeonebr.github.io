<?php
// Altere a variável abaixo colocando o seu email
$destinatario = "rgghost@hotmail.com";

// Verifica se o formulário foi enviado via POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Captura e sanitiza os dados do formulário
    $nome = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_STRING);
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $assunto = filter_input(INPUT_POST, 'assunto', FILTER_SANITIZE_STRING);
    $mensagem = filter_input(INPUT_POST, 'mensagem', FILTER_SANITIZE_STRING);

    // Validação básica dos campos
    if (empty($nome) || empty($email) || empty($assunto) || empty($mensagem)) {
        die("Por favor, preencha todos os campos do formulário.");
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        die("O endereço de e-mail fornecido é inválido.");
    }

    // Monta o corpo do e-mail
    $body = "===================================" . "\n";
    $body .= "FALE CONOSCO - RGGHOST" . "\n";
    $body .= "===================================" . "\n\n";
    $body .= "Nome: " . $nome . "\n";
    $body .= "Email: " . $email . "\n";
    $body .= "Mensagem: " . $mensagem . "\n\n";
    $body .= "===================================" . "\n";

    // Configura os cabeçalhos do e-mail
    $headers = "From: " . $email . "\r\n";
    $headers .= "Reply-To: " . $email . "\r\n";
    $headers .= "Content-Type: text/plain; charset=UTF-8\r\n";

    // Tenta enviar o e-mail
    if (mail($destinatario, $assunto, $body, $headers)) {
        // Redireciona para a página de obrigado
        header("Location: obrigado.htm");
        exit();
    } else {
        // Exibe mensagem de erro caso o e-mail não seja enviado
        echo "Erro ao enviar o e-mail. Por favor, tente novamente mais tarde.";
    }
} else {
    // Se o formulário não foi enviado via POST, exibe uma mensagem de erro
    echo "Acesso inválido ao script.";
}
?>
