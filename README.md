# SACI - Sistema Automatizado de Gerenciamento de Inventário

Projeto realizado por dois alunos da UTFPR-CP(Universidade Tecnológica Federal do Paraná - Campus Cornélio Procópio), o projeto consiste em um protótipo de sistema WEB que controla os empréstimos e devoluções de diversos itens dispostos num inventário.

O projeto foi moldado teoricamente em torno das necessidades organizacionais presentes na própria universidade. É extremamente necessário existir um controle dos utensílios gerais que podem estar sempre sendo utilizados por diversas pessoas, o sistema prevê esse controle. Embora tenha sido moldado em torno desta necessidade, o projeto foi desenvolvido de forma que seja possível aplicá-lo em qualquer outra situação, possivelmente com alguma mudança mínima no código.

## Funcionamento do sistema

* Em todas as salas que possuirem itens, quaisquer que sejam, existirá um microcontrolador com uma antena RFID;
* Todos os itens possuirão cadastros em um Banco de Dados e Tags RFID únicas;
* Cada pessoa que tenha acesso aos itens, podendo realizar empréstimos, também possuirá cadastro no Banco de Dados e Tag única;
* Quando uma pessoa entrar em uma sala, pegar um item e passar pela porta, a antena irá captar as tags e o microcontrolador irá enviar ambas para o servidor;
* O servidor irá acessar o Banco de Dados e verificar se aquela ação se trata de um Empréstimo ou Devolução;
* O servidor irá fazer as alterações no Banco de Dados de acordo com a ação.

## Funcionalidades adicionais: Página WEB

* Acesso de usuários podendo gerar relatórios dos Empréstimos e Devoluções
* Possibilidade de buscar por itens

## Métodos utilizados no projeto

* Microcontrolador utilizado: Arduino
* SGBD utilizado: PhpMyAdmin
* Banco de Dados utilizado: MySQL
* Linguagens de programação utilizadas:
	* Página WEB:
		* Front-End: JavaScript, HTML e CSS;
		* Back-End: PHP.
	* Microcontrolador: C/C++.
	* Sistema Geral: PHP.
	* Consultas ao Banco: SQL.	

## Andamento do Projeto

O projeto ainda está em fase de desenvolvimento pelos alunos. 
