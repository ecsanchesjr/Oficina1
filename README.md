A ideia do sistema é uma forma de manter organizado e controlado a entrada e saída de objetos de um ambiente.

Um exemplo simples:
	Uma pequena empresa possuí três salas com equipamentos diversos, toda semana é necessária que algum funcionário vá até as salas e faça a verificação dos equipamentos de cada uma.
	Opções de problemas:
		Pode faltar equipamentos em uma sala e sobrar na outra
		Pode faltar em todas
		Pode faltar em alguma e não sobrar nas outras
	Cada opção de problema se refere a situação da entrada e saída de pessoas utilizando os equipamentos e:
		Não devolvendo, talvez seu uso não foi terminado
		Não devolvendo no local correto, outra sala
		Ocorreu perda do equipamento

O sistema é uma forma de manter organizado e minimizar ao máximo esses problemas

Cada sala de equipamentos possuiria um Leitor RFID em sua entrada, os equipamentos contidos nela possuiriam uma etiqueta com um código que o Leitor RFID irá ler quando o equipamento é retirado da sala.
Nesse momento, será dado um sinal para o sistema de que aquele produto foi retirado, o sistema irá parear o código com os dados contidos num Banco de Dados e irá verificar informações do produto.
Com as informações, o sistema irá dar baixa no equipamento, salvando um dado de que na data específica, contando com a hora, tal equipamento foi retirado.
Quando esse equipamento foi devolvido, ou seja, o leitor na entrada do ambiente percebeu sua entrada, irá mandar o código para o sistema marcar como devolvido o equipamento.

Para o caso de um equipamento devolvido em sala errada, o sistema daria baixa no mesmo porém com uma marcação de "devolução em sala errada".

Futuro.

Um maior controle poderia ser implementado caso todas as pessoas que teriam acesso as salas possuísem uma identificação no Banco e um RFID
Com isso, poderia, além da data e hora da saída do equipamento, poderia ficar salvo a pessoa que o "emprestou"

