-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Tempo de geração: 30/05/2022 às 10:55
-- Versão do servidor: 5.6.41-84.1
-- Versão do PHP: 7.3.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `portf764_newflix`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `categoria`
--

CREATE TABLE `categoria` (
  `id_categoria` int(11) NOT NULL,
  `categoria` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Despejando dados para a tabela `categoria`
--

INSERT INTO `categoria` (`id_categoria`, `categoria`) VALUES
(1, 'Ação'),
(2, 'Aventura'),
(3, 'Desenho'),
(4, 'Drama'),
(5, 'Fantasia'),
(6, 'Comédia romântica');

-- --------------------------------------------------------

--
-- Estrutura para tabela `episodios`
--

CREATE TABLE `episodios` (
  `id` int(11) NOT NULL,
  `title_ep` varchar(255) NOT NULL,
  `description_ep` longtext NOT NULL,
  `link` varchar(255) NOT NULL,
  `id_ep` int(11) NOT NULL,
  `ordem_ep` int(11) NOT NULL DEFAULT '0',
  `id_temp` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Despejando dados para a tabela `episodios`
--

INSERT INTO `episodios` (`id`, `title_ep`, `description_ep`, `link`, `id_ep`, `ordem_ep`, `id_temp`) VALUES
(1, 'Episódio 1', 'Em 1919, após a Grande Guerra, os Peaky Blinders, liderados por Thomas \"Tommy\" Shelby, se apropriam de uma remessa de armas da fábrica de armas local. Winston Churchill envia o inspetor Campbell a Birmingham para recuperar as armas. Campbell analisa o histórico de Tommy, o qual constata que ele foi um condecorado ex-sargento-mor. Tia Polly pede que Tommy devolva as armas, mas ele sente que pode usá-las a seu favor. Seu irmão Arthur não concorda com Tommy sobre forjar corridas de cavalos, acreditando que isso causará problemas com Billy Kimber, que comanda as corridas. O inspetor Campbell e seus homens capturam Arthur e o espancam enquanto perguntam sobre o roubo de armas. Campbell propõe que Arthur e sua turma trabalhem com ele para encontrar as armas. A irmã de Tommy, Ada, está envolvida com Freddie Thorne, um comunista. A garçonete Grace começa a trabalhar no bar. Sem o conhecimento dos Peaky Blinders, ela foi colocada em Birmingham pelo Inspetor Campbell para ajudar a encontrar as armas. Danny tem outro episódio de TEPT e mata um empresário italiano. Para evitar uma guerra com os italianos, Tommy concorda em matar Danny, com os italianos assistindo do outro lado do canal. No entanto, a morte de Danny é falsa e ele vai para Londres em uma missão especial', 'filmes/video1.mp4', 3, 0, 1),
(2, 'Episódio 2', 'Tommy, Arthur e John se encontram com os Lee para comprar um cavalo para a próxima corrida. Os Lees insultam os Peaky Blinders, uma briga começa e depois Tommy recebe uma bala com seu nome. A força especial de Campbell lança uma ofensiva surpresa, visando atacar a comunistas e procurando pelas armas. Freddie e Ada conseguem escapar, mas Freddie precisa deixar a cidade. Campbell confronta Polly e ataca todos os estabelecimentos Shelby. Em retaliação, Tommy consegue que um repórter escreva sobre um protesto contra a queima da foto do Rei, o que leva Churchill a pressionar Campbell. Tommy se encontra com Campbell e lhe dá um ultimato: se os Peaky Blinders forem deixados em paz, ele devolverá as armas; se o inspetor interferir em seus planos, Tommy enviará as armas para o IRA e arruinará o trabalho de Campbell em Belfast. Campbell concorda, mas depois instrui Grace a se aproximar de Tommy e encontrar a localização das armas. Polly percebe que Ada está grávida e conta a Tommy, que ameaça matar Freddie. No entanto, ele afirma mais tarde a Freddie que vai levar Ada embora; Em vez disso, Freddie pede Ada em casamento e decide ficar na cidade. Billy Kimber e seus homens enfrentam os Shelbys, mas Tommy os convence a unir forças na luta contra os Lee, seu inimigo comum', 'filmes/video2.mp4', 3, 1, 1),
(3, 'Episódio 3', 'Ada e Freddie se casam, e Tia Polly envia dinheiro para eles saírem do país. Apesar dos esforços de Tommy para manter as armas em segredo, parece que as pessoas continuam descobrindo sobre elas, incluindo dois membros do IRA. Grace os ouve tentando chantagear Tommy e segue um deles, mas ele a ataca. Grace consegue atirar em seu agressor em legítima defesa. Tommy avisa Kimber que o pessoal da família Lee mais uma vez roubará os apostadores de Kimber nas corridas. Tommy traz Grace como seu par para corridas em Cheltenham na tentativa de distrair Kimber, bem como convencê-lo de que ele deve contratar os Blinders como seus seguranças. Kimber questiona se ele pode passar algum tempo sozinho com Grace, Tommy concorda. No último minuto, ele muda de ideia e afirma que Grace é na verdade uma prostituta com \"gonorreia\". Freddie decide que Tommy não vai assustá-lo e retorna.', 'filmes/video3.mp4', 3, 2, 1),
(4, 'Episódio 4', 'Tommy torna seu negócio legítimo ao obter uma licença de apostas. Embora ele não confie muito nela e suspeite dela, Tommy contrata Grace como sua secretária. John reúne a família para contar que decidiu que seus quatro filhos precisam de uma mãe: ele decidiu que quer se casar com Lizzie, uma prostituta local. Tommy desaprova porque acha que Lizzie não desistiu de sua antiga profissão. Os Lee roubam o antro de jogo dos Shelbys como vingança para os Peaky Blinders, que protegeram os apostadores de Billy Kimber nas corridas. Tommy decide estabelecer uma trégua com a família Lee para que ele possa ter um aliado contra Billy Kimber e casa John com a filha de Lees, Esme, para consumar o acordo. Ada vai ao casamento, mas logo depois entra em trabalho de parto. Freddie vem ver o novo bebê, mas acaba preso quando reaparece', 'filmes/video4.mp4', 3, 3, 1),
(5, 'Episódio 5', 'Acreditando que Tommy traiu Freddie, Ada não quer ver ou falar com sua família. Embora Arthur Sr. tenha abandonado a família há uma década, ele volta para a cidade. Tommy não quer nada com ele, mas Arthur Jr. acredita que ele mudou e quer fazer de tudo para ajudá-lo, inclusive financiar a abertura de hotéis na América. No entanto, Arthur Sr. sai com o dinheiro que Arthur Jr. deu a ele. Quando Arthur Jr. finalmente encontra seu pai, Arthur Sr. admite que nunca teve planos e sentiu que a família Shelby o devia. Um membro do IRA começa a perguntar sobre o homem que Grace matou. Grace e Tommy matam os outros membros do IRA. Agora apaixonada por Tommy, Grace diz ao inspetor Campbell que se ela lhe der a localização das armas, ele terá que deixar Tommy e sua família em paz. Ela suspeita que as armas estão enterradas em uma cova falsa depois de descobrir que Danny não está realmente morto, mas que está em Londres a negócios para a família Shelby. Grace entrega o local ao inspetor Campbell e renuncia ao serviço para a coroa. Como ela renunciou e as armas foram descobertas, com exceção de uma, o inspetor Campbell pede ela em casamento, mas Grace rejeita', 'filmes/video5.mp4', 3, 4, 1),
(6, 'Episódio 6', 'O inspetor Campbell sabe que Grace está com Tommy. No entanto, ele confirma a Winston Churchill que Grace deve receber alguns elogios por sua parte em encontrar as armas desaparecidas. Polly se encontra com Grace para revelar que ela conhece o segredo de Grace e que ela nunca a perdoará. Os Peaky Blinders, liderados por Danny, libertam Freddie da prisão. Tommy reúne os Peaky Blinders e os Lees para enfrentar os homens de Kimber nas pistas, mas Kimber pega os Shelbys desprevenidos e em número menor ao confrontá-los em Birmingham. Freddie ajuda os Peaky Blinders trazendo a metralhadora das armas roubadas, mas Ada pula no meio do tiroteio tentando trazer a paz. Kimber atira no Peaky Blinders, ferindo Tommy e matando Danny. Tommy, por sua vez, atira em Kimber. Tommy encontra Grace e ela diz que o ama e que vai passar alguns dias em Londres; ela tem uma ideia de como eles podem ficar juntos. Tommy escreve uma carta e joga uma moeda para decidir se ele irá com Grace. Enquanto isso acontece, Campbell confronta Grace na estação ferroviária e aponta sua pistola para ela. Conforme a cena desaparece, há o barulho de um tiro', 'filmes/video6.mp4', 3, 5, 1),
(7, 'Episódio 7', 'O inspetor Campbell sabe que Grace está com Tommy. No entanto, ele confirma a Winston Churchill que Grace deve receber alguns elogios por sua parte em encontrar as armas desaparecidas. Polly se encontra com Grace para revelar que ela conhece o segredo de Grace e que ela nunca a perdoará. Os Peaky Blinders, liderados por Danny, libertam Freddie da prisão. Tommy reúne os Peaky Blinders e os Lees para enfrentar os homens de Kimber nas pistas, mas Kimber pega os Shelbys desprevenidos e em número menor ao confrontá-los em Birmingham. Freddie ajuda os Peaky Blinders trazendo a metralhadora das armas roubadas, mas Ada pula no meio do tiroteio tentando trazer a paz. Kimber atira no Peaky Blinders, ferindo Tommy e matando Danny. Tommy, por sua vez, atira em Kimber. Tommy encontra Grace e ela diz que o ama e que vai passar alguns dias em Londres; ela tem uma ideia de como eles podem ficar juntos. Tommy escreve uma carta e joga uma moeda para decidir se ele irá com Grace. Enquanto isso acontece, Campbell confronta Grace na estação ferroviária e aponta sua pistola para ela. Conforme a cena desaparece, há o barulho de um tiro', 'filmes/video7.mp4', 3, 6, 1),
(8, 'Episódio 8', 'O inspetor Campbell sabe que Grace está com Tommy. No entanto, ele confirma a Winston Churchill que Grace deve receber alguns elogios por sua parte em encontrar as armas desaparecidas. Polly se encontra com Grace para revelar que ela conhece o segredo de Grace e que ela nunca a perdoará. Os Peaky Blinders, liderados por Danny, libertam Freddie da prisão. Tommy reúne os Peaky Blinders e os Lees para enfrentar os homens de Kimber nas pistas, mas Kimber pega os Shelbys desprevenidos e em número menor ao confrontá-los em Birmingham. Freddie ajuda os Peaky Blinders trazendo a metralhadora das armas roubadas, mas Ada pula no meio do tiroteio tentando trazer a paz. Kimber atira no Peaky Blinders, ferindo Tommy e matando Danny. Tommy, por sua vez, atira em Kimber. Tommy encontra Grace e ela diz que o ama e que vai passar alguns dias em Londres; ela tem uma ideia de como eles podem ficar juntos. Tommy escreve uma carta e joga uma moeda para decidir se ele irá com Grace. Enquanto isso acontece, Campbell confronta Grace na estação ferroviária e aponta sua pistola para ela. Conforme a cena desaparece, há o barulho de um tiro', 'filmes/video8.mp4', 3, 7, 1),
(9, 'Episódio 9', 'O inspetor Campbell sabe que Grace está com Tommy. No entanto, ele confirma a Winston Churchill que Grace deve receber alguns elogios por sua parte em encontrar as armas desaparecidas. Polly se encontra com Grace para revelar que ela conhece o segredo de Grace e que ela nunca a perdoará. Os Peaky Blinders, liderados por Danny, libertam Freddie da prisão. Tommy reúne os Peaky Blinders e os Lees para enfrentar os homens de Kimber nas pistas, mas Kimber pega os Shelbys desprevenidos e em número menor ao confrontá-los em Birmingham. Freddie ajuda os Peaky Blinders trazendo a metralhadora das armas roubadas, mas Ada pula no meio do tiroteio tentando trazer a paz. Kimber atira no Peaky Blinders, ferindo Tommy e matando Danny. Tommy, por sua vez, atira em Kimber. Tommy encontra Grace e ela diz que o ama e que vai passar alguns dias em Londres; ela tem uma ideia de como eles podem ficar juntos. Tommy escreve uma carta e joga uma moeda para decidir se ele irá com Grace. Enquanto isso acontece, Campbell confronta Grace na estação ferroviária e aponta sua pistola para ela. Conforme a cena desaparece, há o barulho de um tiro', 'filmes/video9.mp4', 3, 8, 1),
(10, 'Episódio 1', 'O inspetor Campbell sabe que Grace está com Tommy. No entanto, ele confirma a Winston Churchill que Grace deve receber alguns elogios por sua parte em encontrar as armas desaparecidas. Polly se encontra com Grace para revelar que ela conhece o segredo de Grace e que ela nunca a perdoará. Os Peaky Blinders, liderados por Danny, libertam Freddie da prisão. Tommy reúne os Peaky Blinders e os Lees para enfrentar os homens de Kimber nas pistas, mas Kimber pega os Shelbys desprevenidos e em número menor ao confrontá-los em Birmingham. Freddie ajuda os Peaky Blinders trazendo a metralhadora das armas roubadas, mas Ada pula no meio do tiroteio tentando trazer a paz. Kimber atira no Peaky Blinders, ferindo Tommy e matando Danny. Tommy, por sua vez, atira em Kimber. Tommy encontra Grace e ela diz que o ama e que vai passar alguns dias em Londres; ela tem uma ideia de como eles podem ficar juntos. Tommy escreve uma carta e joga uma moeda para decidir se ele irá com Grace. Enquanto isso acontece, Campbell confronta Grace na estação ferroviária e aponta sua pistola para ela. Conforme a cena desaparece, há o barulho de um tiro', 'filmes/video10.mp4', 3, 9, 2),
(11, 'Episódio 2', 'O inspetor Campbell sabe que Grace está com Tommy. No entanto, ele confirma a Winston Churchill que Grace deve receber alguns elogios por sua parte em encontrar as armas desaparecidas. Polly se encontra com Grace para revelar que ela conhece o segredo de Grace e que ela nunca a perdoará. Os Peaky Blinders, liderados por Danny, libertam Freddie da prisão. Tommy reúne os Peaky Blinders e os Lees para enfrentar os homens de Kimber nas pistas, mas Kimber pega os Shelbys desprevenidos e em número menor ao confrontá-los em Birmingham. Freddie ajuda os Peaky Blinders trazendo a metralhadora das armas roubadas, mas Ada pula no meio do tiroteio tentando trazer a paz. Kimber atira no Peaky Blinders, ferindo Tommy e matando Danny. Tommy, por sua vez, atira em Kimber. Tommy encontra Grace e ela diz que o ama e que vai passar alguns dias em Londres; ela tem uma ideia de como eles podem ficar juntos. Tommy escreve uma carta e joga uma moeda para decidir se ele irá com Grace. Enquanto isso acontece, Campbell confronta Grace na estação ferroviária e aponta sua pistola para ela. Conforme a cena desaparece, há o barulho de um tiro', 'filmes/video11.mp4', 3, 10, 2),
(12, 'Episódio 3', 'O inspetor Campbell sabe que Grace está com Tommy. No entanto, ele confirma a Winston Churchill que Grace deve receber alguns elogios por sua parte em encontrar as armas desaparecidas. Polly se encontra com Grace para revelar que ela conhece o segredo de Grace e que ela nunca a perdoará. Os Peaky Blinders, liderados por Danny, libertam Freddie da prisão. Tommy reúne os Peaky Blinders e os Lees para enfrentar os homens de Kimber nas pistas, mas Kimber pega os Shelbys desprevenidos e em número menor ao confrontá-los em Birmingham. Freddie ajuda os Peaky Blinders trazendo a metralhadora das armas roubadas, mas Ada pula no meio do tiroteio tentando trazer a paz. Kimber atira no Peaky Blinders, ferindo Tommy e matando Danny. Tommy, por sua vez, atira em Kimber. Tommy encontra Grace e ela diz que o ama e que vai passar alguns dias em Londres; ela tem uma ideia de como eles podem ficar juntos. Tommy escreve uma carta e joga uma moeda para decidir se ele irá com Grace. Enquanto isso acontece, Campbell confronta Grace na estação ferroviária e aponta sua pistola para ela. Conforme a cena desaparece, há o barulho de um tiro', 'filmes/video12.mp4', 3, 11, 2),
(13, 'Episódio 1', 'O inspetor Campbell sabe que Grace está com Tommy. No entanto, ele confirma a Winston Churchill que Grace deve receber alguns elogios por sua parte em encontrar as armas desaparecidas. Polly se encontra com Grace para revelar que ela conhece o segredo de Grace e que ela nunca a perdoará. Os Peaky Blinders, liderados por Danny, libertam Freddie da prisão. Tommy reúne os Peaky Blinders e os Lees para enfrentar os homens de Kimber nas pistas, mas Kimber pega os Shelbys desprevenidos e em número menor ao confrontá-los em Birmingham. Freddie ajuda os Peaky Blinders trazendo a metralhadora das armas roubadas, mas Ada pula no meio do tiroteio tentando trazer a paz. Kimber atira no Peaky Blinders, ferindo Tommy e matando Danny. Tommy, por sua vez, atira em Kimber. Tommy encontra Grace e ela diz que o ama e que vai passar alguns dias em Londres; ela tem uma ideia de como eles podem ficar juntos. Tommy escreve uma carta e joga uma moeda para decidir se ele irá com Grace. Enquanto isso acontece, Campbell confronta Grace na estação ferroviária e aponta sua pistola para ela. Conforme a cena desaparece, há o barulho de um tiro', 'filmes/video13.mp4', 3, 12, 3),
(14, 'Episódio 2', 'O inspetor Campbell sabe que Grace está com Tommy. No entanto, ele confirma a Winston Churchill que Grace deve receber alguns elogios por sua parte em encontrar as armas desaparecidas. Polly se encontra com Grace para revelar que ela conhece o segredo de Grace e que ela nunca a perdoará. Os Peaky Blinders, liderados por Danny, libertam Freddie da prisão. Tommy reúne os Peaky Blinders e os Lees para enfrentar os homens de Kimber nas pistas, mas Kimber pega os Shelbys desprevenidos e em número menor ao confrontá-los em Birmingham. Freddie ajuda os Peaky Blinders trazendo a metralhadora das armas roubadas, mas Ada pula no meio do tiroteio tentando trazer a paz. Kimber atira no Peaky Blinders, ferindo Tommy e matando Danny. Tommy, por sua vez, atira em Kimber. Tommy encontra Grace e ela diz que o ama e que vai passar alguns dias em Londres; ela tem uma ideia de como eles podem ficar juntos. Tommy escreve uma carta e joga uma moeda para decidir se ele irá com Grace. Enquanto isso acontece, Campbell confronta Grace na estação ferroviária e aponta sua pistola para ela. Conforme a cena desaparece, há o barulho de um tiro', 'filmes/video14.mp4', 3, 13, 3),
(15, 'Episódio 1', 'BLA BLA BLA BLA BLA BLA BLA BLA BLA BLA BLA BLA BLA BLA BLA BLA BLA', 'filmes/video1.mp4', 5, 0, 1),
(16, 'Episódio 2', 'BLA BLA BLA BLA BLA BLA BLA BLA BLA BLA BLA BLA BLA BLA BLA BLA BLA', 'filmes/video2.mp4', 5, 1, 1),
(17, 'Episódio 3', 'BLA BLA BLA BLA BLA BLA BLA BLA BLA BLA BLA BLA BLA BLA BLA BLA BLA', 'filmes/video3.mp4', 5, 2, 1),
(18, 'Episódio 4', 'BLA BLA BLA BLA BLA BLA BLA BLA BLA BLA BLA BLA BLA BLA BLA BLA BLA', 'filmes/video4.mp4', 5, 3, 1),
(19, 'Episódio 5', 'BLA BLA BLA BLA BLA BLA BLA BLA BLA BLA BLA BLA BLA BLA BLA BLA BLA', 'filmes/video5.mp4', 5, 4, 1),
(20, 'Episódio 6', 'BLA BLA BLA BLA BLA BLA BLA BLA BLA BLA BLA BLA BLA BLA BLA BLA BLA', 'filmes/video6.mp4', 5, 5, 1),
(21, 'Episódio 7', 'BLA BLA BLA BLA BLA BLA BLA BLA BLA BLA BLA BLA BLA BLA BLA BLA BLA', 'filmes/video7.mp4', 5, 6, 1),
(22, 'Episódio 8', 'BLA BLA BLA BLA BLA BLA BLA BLA BLA BLA BLA BLA BLA BLA BLA BLA BLA', 'filmes/video8.mp4', 5, 7, 1),
(23, 'Episódio 9', 'BLA BLA BLA BLA BLA BLA BLA BLA BLA BLA BLA BLA BLA BLA BLA BLA BLA', 'filmes/video9.mp4', 5, 8, 1),
(24, 'Episódio 10', 'BLA BLA BLA BLA BLA BLA BLA BLA BLA BLA BLA BLA BLA BLA BLA BLA BLA', 'filmes/video10.mp4', 5, 9, 1),
(25, 'Episódio 1', 'BLA BLA BLA BLA BLA BLA BLA BLA BLA BLA BLA BLA BLA BLA BLA BLA BLA', 'filmes/video11.mp4', 7, 0, 1),
(26, 'Episódio 2', 'BLA BLA BLA BLA BLA BLA BLA BLA BLA BLA BLA BLA BLA BLA BLA BLA BLA', 'filmes/video12.mp4', 7, 1, 1),
(27, 'Episódio 3', 'BLA BLA BLA BLA BLA BLA BLA BLA BLA BLA BLA BLA BLA BLA BLA BLA BLA', 'filmes/video13.mp4', 7, 2, 1),
(28, 'Episódio 4', 'BLA BLA BLA BLA BLA BLA BLA BLA BLA BLA BLA BLA BLA BLA BLA BLA BLA', 'filmes/video14.mp4', 7, 3, 1),
(29, 'Episódio 5', 'BLA BLA BLA BLA BLA BLA BLA BLA BLA BLA BLA BLA BLA BLA BLA BLA BLA', 'filmes/video1.mp4', 7, 4, 1),
(30, 'Episódio 6', 'BLA BLA BLA BLA BLA BLA BLA BLA BLA BLA BLA BLA BLA BLA BLA BLA BLA', 'filmes/video2.mp4', 7, 5, 1),
(31, 'Episódio 1', 'BLA BLA BLA BLA BLA BLA BLA BLA BLA BLA BLA BLA BLA BLA BLA BLA BLA', 'filmes/video3.mp4', 9, 0, 1),
(32, 'Episódio 2', 'BLA BLA BLA BLA BLA BLA BLA BLA BLA BLA BLA BLA BLA BLA BLA BLA BLA', 'filmes/video4.mp4', 9, 1, 1),
(33, 'Episódio 3', 'BLA BLA BLA BLA BLA BLA BLA BLA BLA BLA BLA BLA BLA BLA BLA BLA BLA', 'filmes/video5.mp4', 9, 2, 1),
(34, 'Episódio 4', 'BLA BLA BLA BLA BLA BLA BLA BLA BLA BLA BLA BLA BLA BLA BLA BLA BLA', 'filmes/video6.mp4', 9, 3, 1),
(35, 'Episódio 5', 'BLA BLA BLA BLA BLA BLA BLA BLA BLA BLA BLA BLA BLA BLA BLA BLA BLA', 'filmes/video7.mp4', 9, 4, 1),
(36, 'Episódio 6', 'BLA BLA BLA BLA BLA BLA BLA BLA BLA BLA BLA BLA BLA BLA BLA BLA BLA', 'filmes/video8.mp4', 9, 5, 1),
(37, 'Episódio 7', 'BLA BLA BLA BLA BLA BLA BLA BLA BLA BLA BLA BLA BLA BLA BLA BLA BLA', 'filmes/video9.mp4', 9, 6, 1),
(38, 'Episódio 8', 'BLA BLA BLA BLA BLA BLA BLA BLA BLA BLA BLA BLA BLA BLA BLA BLA BLA', 'filmes/video10.mp4', 9, 7, 1),
(39, 'Episódio 1', 'BLA BLA BLA BLA BLA BLA BLA BLA BLA BLA BLA BLA BLA BLA BLA BLA BLA', 'filmes/video11.mp4', 11, 0, 1),
(40, 'Episódio 2', 'BLA BLA BLA BLA BLA BLA BLA BLA BLA BLA BLA BLA BLA BLA BLA BLA BLA', 'filmes/video12.mp4', 11, 1, 1),
(41, 'Episódio 3', 'BLA BLA BLA BLA BLA BLA BLA BLA BLA BLA BLA BLA BLA BLA BLA BLA BLA', 'filmes/video13.mp4', 11, 2, 1),
(42, 'Episódio 4', 'BLA BLA BLA BLA BLA BLA BLA BLA BLA BLA BLA BLA BLA BLA BLA BLA BLA', 'filmes/video14.mp4', 11, 3, 1),
(43, 'Episódio 5', 'BLA BLA BLA BLA BLA BLA BLA BLA BLA BLA BLA BLA BLA BLA BLA BLA BLA', 'filmes/video1.mp4', 11, 4, 1),
(44, 'Episódio 6', 'BLA BLA BLA BLA BLA BLA BLA BLA BLA BLA BLA BLA BLA BLA BLA BLA BLA', 'filmes/video2.mp4', 11, 5, 1),
(45, 'Episódio 4', 'O inspetor Campbell sabe que Grace está com Tommy. No entanto, ele confirma a Winston Churchill que Grace deve receber alguns elogios por sua parte em encontrar as armas desaparecidas. Polly se encontra com Grace para revelar que ela conhece o segredo de Grace e que ela nunca a perdoará. Os Peaky Blinders, liderados por Danny, libertam Freddie da prisão. Tommy reúne os Peaky Blinders e os Lees para enfrentar os homens de Kimber nas pistas, mas Kimber pega os Shelbys desprevenidos e em número menor ao confrontá-los em Birmingham. Freddie ajuda os Peaky Blinders trazendo a metralhadora das armas roubadas, mas Ada pula no meio do tiroteio tentando trazer a paz. Kimber atira no Peaky Blinders, ferindo Tommy e matando Danny. Tommy, por sua vez, atira em Kimber. Tommy encontra Grace e ela diz que o ama e que vai passar alguns dias em Londres; ela tem uma ideia de como eles podem ficar juntos. Tommy escreve uma carta e joga uma moeda para decidir se ele irá com Grace. Enquanto isso acontece, Campbell confronta Grace na estação ferroviária e aponta sua pistola para ela. Conforme a cena desaparece, há o barulho de um tiro', 'filmes/video3.mp4', 3, 14, 3),
(105, 'sdf', 'sdf', 'sdf', 3, 15, 3),
(108, 'Ep 1', 'asdasdassadasdadsasdads', 'series/FeartheWalkingDead.mp4', 13, 0, 1),
(120, 'Ep 2', 'asddsaasdsdaasda', 'sdf', 13, 1, 1),
(121, 'Ep 3', 'sfdfsdfsfdfssf', 'series/FeartheWalkingDead.mp4', 13, 2, 1),
(123, 'Ep 4', 'sdadsdasadsd', 'series/FeartheWalkingDead.mp4', 13, 3, 1),
(124, 'Ep 5', 'ytfdytdtrdyry', 'series/FeartheWalkingDead.mp4', 13, 4, 1);

-- --------------------------------------------------------

--
-- Estrutura para tabela `fav`
--

CREATE TABLE `fav` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_token` varchar(255) NOT NULL,
  `id_movie` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Despejando dados para a tabela `fav`
--

INSERT INTO `fav` (`id`, `id_user`, `id_token`, `id_movie`) VALUES
(706, 1, 'C87gQMuuGQJqA4tq5ZT2', 14);

-- --------------------------------------------------------

--
-- Estrutura para tabela `gostei`
--

CREATE TABLE `gostei` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_movie` int(11) NOT NULL,
  `id_token` varchar(255) NOT NULL,
  `gostei` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Despejando dados para a tabela `gostei`
--

INSERT INTO `gostei` (`id`, `id_user`, `id_movie`, `id_token`, `gostei`) VALUES
(169, 1, 5, 'ueUctLR3g65jC4HkWPY3', 50),
(171, 2, 8, 'TwOpPYr4zVA3MBsSctMs', 100),
(172, 2, 8, 'd54zIbldgkuN0c9lsfDfUA3', 100),
(173, 1, 8, '8bYlxbHnwsBLsmrjAdiNFCS', 50),
(178, 1, 12, 'lnudwzYHdAnRKOPVtZ76', 100),
(179, 1, 14, '4D3WIFFB7x1lgqVsCZfOFA7', 100),
(180, 1, 4, '4D3WIFFB7x1lgqVsCZfOFA7', 50);

-- --------------------------------------------------------

--
-- Estrutura para tabela `movies`
--

CREATE TABLE `movies` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` varchar(500) NOT NULL,
  `img` varchar(255) NOT NULL,
  `imgcapa` varchar(255) NOT NULL,
  `link_trailer` varchar(255) NOT NULL,
  `link720` varchar(255) NOT NULL,
  `link1080` varchar(255) NOT NULL,
  `link1440` varchar(255) NOT NULL,
  `top10` int(11) NOT NULL DEFAULT '0',
  `idade` varchar(255) NOT NULL DEFAULT '14',
  `destaque` int(1) NOT NULL DEFAULT '0',
  `id_category` int(11) NOT NULL,
  `movie` varchar(255) NOT NULL DEFAULT 'movie',
  `data_env` datetime DEFAULT '2022-05-22 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Despejando dados para a tabela `movies`
--

INSERT INTO `movies` (`id`, `title`, `description`, `img`, `imgcapa`, `link_trailer`, `link720`, `link1080`, `link1440`, `top10`, `idade`, `destaque`, `id_category`, `movie`, `data_env`) VALUES
(2, 'Aladdin', 'Um jovem humilde descobre uma lâmpada mágica, com um gênio que pode lhe conceder desejos. Agora o rapaz quer conquistar a moça por quem se apaixonou, mas o que ele não sabe é que a jovem é uma princesa que está prestes a se noivar. Agora, com a ajuda do gênio, ele tenta se passar por um príncipe para conquistar o amor da moça e a confiança de seu pai.', 'img/fundo/aladdin.jpg', 'img/capa/aladdin.jpg', 'filmes/video1.mp4', 'filmes/video1.mp4', '', '', 6, '14', 0, 2, 'movie', '2022-05-22 00:00:00'),
(4, 'The Batman', 'Da Warner Bros. Pictures chega THE BATMAN com o realizador Matt Reeves no comando e protagonizado por Robert Pattinson no duplo papel de detetive de Gotham City e do seu alter ego, o bilionário solitário Bruce Wayne.', 'img/fundo/batman.jpeg', 'img/capa/batman2022.jpg', 'filmes/video2.mp4', 'filmes/video2.mp4', '', '', 27, '14', 0, 1, 'movie', '2022-05-22 00:00:00'),
(6, 'Red: Crescer é uma Fera', 'Um jovem humilde descobre uma lâmpada mágica, com um gênio que pode lhe conceder desejos. Agora o rapaz quer conquistar a moça por quem se apaixonou, mas o que ele não sabe é que a jovem é uma princesa que está prestes a se noivar. Agora, com a ajuda do gênio, ele tenta se passar por um príncipe para conquistar o amor da moça e a confiança de seu pai.Uma menina de 13 anos começa a se transformar em um panda vermelho gigante sempre que fica animada.', 'img/fundo/606424.jpg', 'img/capa/5746772.jpg', 'filmes/video3.mp4', 'filmes/video3.mp4', '', '', 6, '10', 1, 3, 'movie', '2022-05-22 00:00:00'),
(8, 'Moana - Um Mar de Aventuras', 'Uma jovem parte em uma missão para salvar seu povo. Durante a jornada, Moana conhece o outrora poderoso semideus Maui, que a guia em sua busca para se tornar uma mestre em encontrar caminhos. Juntos, eles navegam pelo oceano em uma viagem incrível.', 'img/fundo/Moana.jpg', 'img/capa/415370.jpg', '', 'filmes/video4.mp4', '', '', 14, '10', 0, 3, 'movie', '2022-05-22 00:00:00'),
(10, 'Homem-Aranha: Sem Volta para Casa', 'O Homem-Aranha precisa lidar com as consequências da sua verdadeira identidade ter sido descoberta.', 'img/fundo/homemaranha.jpg', 'img/capa/HomemAranha.jpg', 'filmes/video5.mp4', 'filmes/video5.mp4', '', '', 1, '14', 0, 5, 'movie', '2022-05-22 00:00:00'),
(12, 'After - Depois do Desencontro', 'Tessa toma uma decisão que pode mudar sua vida, mas isso prejudica seu relacionamento com Hardin. Em meio a brigas constantes, o casal tenta achar um ponto de equilíbrio.', 'img/fundo/unnamed.jpg', 'img/capa/f3d135be.jpg', 'filmes/video6.mp4', 'filmes/video6.mp4', '', '', 7, '14', 0, 4, 'movie', '2022-05-22 00:00:00'),
(14, 'Além das Montanhas', 'A fazendeira Rosemary Uldoon está decidida a conquistar o amor de seu vizinho Anthony Reilly. O problema é que Anthony parece ter herdado uma maldição de família, e não percebe sua bela admiradora.', 'img/fundo/wild.jpg', 'img/capa/wild.jpg', 'filmes/video7.mp4', 'filmes/video7.mp4', 'filmes/wild.mp4', 'filmes/wild.mp4', 30, '14', 0, 6, 'movie', '2022-05-22 00:00:00'),
(16, 'teste', 'teste', 'img/fundo/NEWFLIX_85798p07j7rcps.jpg', 'img/capa/NEWFLIX_85798peaky.jpg', '', 'http://filmes.com/meufilme.mp4', '', '', 0, '15', 0, 4, 'movie', '2022-05-26 11:21:22');

-- --------------------------------------------------------

--
-- Estrutura para tabela `series`
--

CREATE TABLE `series` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` varchar(500) NOT NULL,
  `temporada` int(11) NOT NULL DEFAULT '1',
  `img` varchar(255) NOT NULL,
  `imgcapa` varchar(255) NOT NULL,
  `link_trailer` varchar(255) NOT NULL,
  `idade` int(11) NOT NULL,
  `top10` int(11) NOT NULL DEFAULT '0',
  `destaque` int(1) NOT NULL DEFAULT '0',
  `id_category` int(11) NOT NULL,
  `movie` varchar(255) NOT NULL DEFAULT 'serie',
  `data_env` datetime NOT NULL DEFAULT '2022-05-22 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Despejando dados para a tabela `series`
--

INSERT INTO `series` (`id`, `title`, `description`, `temporada`, `img`, `imgcapa`, `link_trailer`, `idade`, `top10`, `destaque`, `id_category`, `movie`, `data_env`) VALUES
(3, 'Peaky Blinders', 'Uma notória gangue da Inglaterra de 1919 é liderada pelo cruel Tommy Shelby, um criminoso disposto a subir na vida a qualquer preço.', 3, 'img/fundo/peaky-blinders.jpg', 'img/capa/71Pfj.jpg', 'filmes/video1.mp4', 16, 3, 0, 4, 'serie', '2022-05-22 00:00:00'),
(5, 'O Último Reino (The Last Kingdom)', 'Enquanto Alfredo, o Grande, defende seu reino de invasões nórdicas, Uhtred, um saxão criado por vikings, planeja reivindicar o que é seu por direito.', 1, 'img/fundo/the-last-kingdom.jpg', 'img/capa/293866.jpg', 'filmes/video2.mp4', 16, 16, 0, 1, 'serie', '2022-05-22 00:00:00'),
(7, 'Fear the Walking Dead', 'Ambientada em Los Angeles, a série mostra o começo do apocalipse zumbi e a temível desintegração da sociedade pelos olhos de uma família disfuncional, que precisa se unir para tentar sobreviver ao caos do fim dos tempos.', 1, 'img/fundo/fear-the-walking-dead.jpg', 'img/capa/4502728.jpg', 'filmes/video3.mp4', 16, 6, 0, 5, 'serie', '2022-05-22 00:00:00'),
(9, 'Reacher', 'O investigador veterano da polícia militar Jack Reacher é falsamente acusado de assassinato e se vê no meio de uma conspiração mortal em Margrave, Geórgia.', 1, 'img/fundo/Reacher-poster.jpg', 'img/capa/4833003.jpg', 'filmes/video4.mp4', 14, 8, 0, 2, 'serie', '2022-05-22 00:00:00'),
(11, 'Moon Knight', 'Moon Knight é uma minissérie norte-americana de super-herói criada por Jeremy Slater para o Disney+, baseada no personagem de mesmo nome da Marvel Comics. É a sexta série de televisão do Universo Cinematográfico Marvel produzida pelo Marvel Studios, compartilhando continuidade com os filmes da franquia.', 1, 'img/fundo/Fortnite-Scrn20042022.jpg', 'img/capa/51+8KXGf2JL.jpg', 'filmes/video5.mp4', 10, 6, 1, 1, 'serie', '2022-05-22 00:00:00'),
(13, 'test', 'tes', 1, 'img/fundo/NEWFLIX_4648028d7e012cf8fad60e32fa9c07096838aa.jpg', 'img/capa/NEWFLIX_464802estrelas-e-porcentagem-do-ouro-para-avaliação-e-as-revisões-eps-56737796.jpg', 'filmes/video6.mp4', 18, 0, 0, 5, 'serie', '2022-05-25 14:17:41');

-- --------------------------------------------------------

--
-- Estrutura para tabela `sessions`
--

CREATE TABLE `sessions` (
  `session_id` int(11) NOT NULL,
  `session_user_id` int(11) NOT NULL,
  `session_token` varchar(255) NOT NULL,
  `session_serial` varchar(255) NOT NULL,
  `session_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Despejando dados para a tabela `sessions`
--

INSERT INTO `sessions` (`session_id`, `session_user_id`, `session_token`, `session_serial`, `session_status`) VALUES
(8, 1, '4D3WIFFB7x1lgqVsCZfOFA7', '', 1),
(10, 1, 'C87gQMuuGQJqA4tq5ZT2', 'UREy6wA1yGskgcaQqs5w', 2),
(11, 1, 'ueUctLR3g65jC4HkWPY3', 'oHNMqd7rFLfUWWBwFS7K', 3),
(15, 1, 'lnudwzYHdAnRKOPVtZ76', '', 4),
(23, 2, 'd54zIbldgkuN0c9lsfDfUA3', '', 1),
(24, 2, '7f79S8R94B5K5HMlNURl', 'IPCQ3GlsF3kmXtf8LYhQ', 2),
(25, 2, '2CBmpdYphEW1fiPayZra', 'r4rLedlct9ZQF2UGzLf5', 3),
(26, 2, 'TwOpPYr4zVA3MBsSctMs', 'xnq6A5ewRrJtQqjq16CG', 4),
(34, 1, 'NJ2b16aphKgWWhtOgOn2', 'UREy6wA1yGskgcaQqs5w', 2);

-- --------------------------------------------------------

--
-- Estrutura para tabela `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `admin` int(11) NOT NULL DEFAULT '0' COMMENT '1 admin, 0 customer',
  `name` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `user` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `nameuser1` varchar(255) NOT NULL DEFAULT 'Usuario 1',
  `nameuser2` varchar(255) NOT NULL DEFAULT 'Usuario 2',
  `nameuser3` varchar(255) NOT NULL DEFAULT 'Usuario 3',
  `nameuser4` varchar(255) NOT NULL DEFAULT 'Usuario 4',
  `user1` varchar(255) NOT NULL DEFAULT 'img/imgusers/padrao1.jpg',
  `user2` varchar(255) NOT NULL DEFAULT 'img/imgusers/padrao2.jpg',
  `user3` varchar(255) NOT NULL DEFAULT 'img/imgusers/padrao3.jpg',
  `user4` varchar(255) NOT NULL DEFAULT 'img/imgusers/padrao4.jpg'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Despejando dados para a tabela `users`
--

INSERT INTO `users` (`id`, `admin`, `name`, `lastname`, `user`, `password`, `email`, `nameuser1`, `nameuser2`, `nameuser3`, `nameuser4`, `user1`, `user2`, `user3`, `user4`) VALUES
(1, 1, 'Bruno', 'Alves', 'testeAdmin', '5e4dc7a251a274d8c2f0c2098f7b7da0', 'noohalves@hotmail.com', 'Lucifer', 'Cão', 'Eren Yeager', 'Moana', 'img/imgusers/lucifer.jpg', 'img/imgusers/exemplo.jpg', 'img/imgusers/attackontitan.jpg', 'img/imgusers/moana.jpg'),
(2, 0, 'Bruno2', 'Alves2', 'teste', '698dc19d489c4e4db73e28a713eab07b', 'noohalves2@hotmail.com', 'Teste', 'Aaaa', 'Usuario 3', 'Usuario 4', 'img/imgusers/lucifer.jpg', 'img/imgusers/attackontitan.jpg', 'img/imgusers/padrao3.jpg', 'img/imgusers/padrao4.jpg');

-- --------------------------------------------------------

--
-- Estrutura para tabela `users_img`
--

CREATE TABLE `users_img` (
  `id_img` int(11) NOT NULL,
  `destino` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Despejando dados para a tabela `users_img`
--

INSERT INTO `users_img` (`id_img`, `destino`) VALUES
(1, 'img/imgusers/moana.jpg'),
(2, 'img/imgusers/lucifer.jpg'),
(3, 'img/imgusers/exemplo.jpg'),
(4, 'img/imgusers/attackontitan.jpg'),
(9, 'img/imgusers/padrao1.jpg'),
(10, 'img/imgusers/padrao2.jpg'),
(11, 'img/imgusers/padrao3.jpg'),
(12, 'img/imgusers/padrao4.jpg');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`id_categoria`);

--
-- Índices de tabela `episodios`
--
ALTER TABLE `episodios`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `fav`
--
ALTER TABLE `fav`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `gostei`
--
ALTER TABLE `gostei`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `movies`
--
ALTER TABLE `movies`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `series`
--
ALTER TABLE `series`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`session_id`);

--
-- Índices de tabela `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `users_img`
--
ALTER TABLE `users_img`
  ADD PRIMARY KEY (`id_img`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `categoria`
--
ALTER TABLE `categoria`
  MODIFY `id_categoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=108;

--
-- AUTO_INCREMENT de tabela `episodios`
--
ALTER TABLE `episodios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=129;

--
-- AUTO_INCREMENT de tabela `fav`
--
ALTER TABLE `fav`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=716;

--
-- AUTO_INCREMENT de tabela `gostei`
--
ALTER TABLE `gostei`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=181;

--
-- AUTO_INCREMENT de tabela `movies`
--
ALTER TABLE `movies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT de tabela `series`
--
ALTER TABLE `series`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de tabela `sessions`
--
ALTER TABLE `sessions`
  MODIFY `session_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT de tabela `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `users_img`
--
ALTER TABLE `users_img`
  MODIFY `id_img` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
