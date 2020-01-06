-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 13-Jun-2018 às 23:08
-- Versão do servidor: 10.1.21-MariaDB
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `descubranews`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `getCandidatos` (IN `p_codCandidato` INT(11))  NO SQL
BEGIN
IF p_codCandidato = 0 THEN
SELECT c.codCandidato,c.nomeCandidato,c.dtNascto,c.caminhoImagem,c.biografia,c.ativo, c.legendaPartido, 
p.legendaPartido, p.nomePartido, p.caminhoImagemPartido
FROM candidato c  INNER JOIN partido p ON c.legendaPartido = p.legendaPartido WHERE c.ativo = 1 and p.ativo = 1;
ELSE
SELECT c.codCandidato,c.nomeCandidato,c.dtNascto,c.caminhoImagem,c.biografia,c.ativo, c.legendaPartido, 
p.nomePartido, p.caminhoImagemPartido
FROM candidato c  INNER JOIN partido p ON c.legendaPartido = p.legendaPartido WHERE c.ativo = 1 and p.ativo = 1
AND c.codCandidato = p_codCandidato;
END IF;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `getDadosUsuario` (IN `p_idUsuario` INT(11))  NO SQL
SELECT * from usuarios u WHERE u.idUsuario = p_idUsuario LIMIT 1$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `getNoticias` (IN `p_busca` INT(11))  BEGIN
	IF p_busca = 1 THEN
		SELECT 		* 
        FROM 		noticia 
        where		ativo = 1
        ORDER by 	caminhoImagem 
        AND 		dtNoticia;        
	ELSE IF p_busca = 2 THEN
		SELECT 		* 
        FROM 		noticia 
        WHERE 		codCandidato IS NOT NULL
        and			ativo = 1;
	ELSE IF p_busca = 3 THEN
		SELECT 		* 
        FROM		noticia 
        WHERE 		legendaPartido 	IS NULL
		AND			codCandidato 	IS NULL
        and			ativo = 1;
			END IF;
		END IF;
    END IF;    
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `getNoticiasAdm` (IN `p_numNoticia` INT(11))  BEGIN
	IF p_numNoticia = 0 THEN
		select		n.numNoticia
					,n.titulo
                    ,n.dtNoticia
                    ,n.texto
                    ,n.fonte
                    ,n.codCandidato
                    ,n.legendaPartido
                    ,n.idGoogleNews
                    ,n.caminhoImagem
                    ,n.autor                                        
                    ,concat(c.nomeCandidato,' - ',l.nomePartido) as nomeCandidato
                    ,p.nomePartido     	as 	nomePartidoNoticia                       
		FROM 		noticia 	n        
        INNER	JOIN	candidato 	c	ON 	(c.codCandidato = n.codCandidato or n.codCandidato is null) 
        LEFT JOIN	partido		l	ON	(l.legendaPartido = c.legendaPartido and n.codCandidato is not null)
        LEFT JOIN	partido		p	ON	(p.legendaPartido = n.legendaPartido)        
		WHERE		n.ativo = 1;			
    ELSE
    
		select		n.numNoticia
					,n.titulo
                    ,n.dtNoticia
                    ,n.texto
                    ,n.fonte
                    ,n.codCandidato
                    ,n.legendaPartido
                    ,n.idGoogleNews
                    ,n.caminhoImagem
                    ,n.autor                    
                    ,c.codCandidato 	
                    ,c.nomeCandidato          
                    ,p.nomePartido     	as 	nomePartidoNoticia   
                    ,l.nomePartido		as	nomePartidoCandidato
		FROM 		noticia 	n        
        INNER	JOIN	candidato 	c	ON 	(c.codCandidato = n.codCandidato or n.codCandidato is null) 
        LEFT JOIN	partido		l	ON	(l.legendaPartido = c.legendaPartido and n.codCandidato is not null)
        LEFT JOIN	partido		p	ON	(p.legendaPartido = n.legendaPartido)        
		WHERE		n.ativo = 1			
        AND			n.numNoticia = p_numNoticia;
    END IF;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `getNoticiasTop3` ()  NO SQL
SELECT 		* 
    from 		noticia  n
    where 		ativo = 1 
    ORDER by 	n.dtNoticia  desc
    LIMIT 		4$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `getPartidos` (IN `p_legendaPartido` INT(11))  BEGIN
	IF p_legendaPartido  = 0 THEN
		select 		p.legendaPartido
					,p.nomePartido
                    ,p.caminhoImagemPartido
		from 		partido p
		where		p.ativo = 1;
    ELSE
		select 		p.legendaPartido
					,p.nomePartido
                    ,p.caminhoImagemPartido
		from 		partido p
		where		p.ativo = 1
        and  		p.legendaPartido = p_legendaPartido;
    END IF;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `getPropostas` (IN `p_numProposta` INT(11))  BEGIN
	IF p_numProposta = 0 THEN
		select 		p.numProposta
					,l.nomePartido
                    ,c.nomeCandidato
                    ,p.descricaoProposta
                    ,p.imagemProposta                    
                    ,l.caminhoImagemPartido
                    ,c.codCandidato
		FROM		proposta 	p 
        INNER JOIN 	candidato 	c 	ON p.codCandidato = c.codCandidato
        INNER JOIN 	partido 	l	ON c.legendaPartido = l.legendaPartido
		WHERE 		p.ativo = 	1;	
    ELSE
		select 		p.numProposta
					,l.nomePartido
                    ,c.nomeCandidato
                    ,p.descricaoProposta
                    ,p.imagemProposta                    
                    ,l.caminhoImagemPartido
                    ,c.codCandidato
		FROM		proposta 	p 
        INNER JOIN 	candidato 	c 	ON p.codCandidato = c.codCandidato
        INNER JOIN 	partido 	l	ON c.legendaPartido = l.legendaPartido
		WHERE 		p.ativo = 	1
        AND			p.numProposta = p_numProposta;	    
    END IF;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `getUsuarios` (IN `p_idUsuario` INT(11))  NO SQL
BEGIN
IF p_idUsuario = 0 THEN
SELECT u.idUsuario,u.nomeUsuario,u.email FROM usuarios u WHERE u.ativo = 1;
ELSE
SELECT u.idUsuario,u.nomeUsuario,u.email FROM usuarios u WHERE u.idUsuario = p_idUsuario AND u.ativo =1;
END IF;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `getVotacao` ()  NO SQL
SELECT 	DISTINCT v.qtdVotos, c.nomeCandidato, c.codVotacao from votacao v
INNER JOIN candidato c on c.codVotacao = v.codVotacao and c.codCandidato = v.codCandidato$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `procCadastraCandidato` (IN `p_codCandidato` INT(11), IN `p_nome` VARCHAR(55), IN `p_dataNascimento` DATETIME, IN `p_legendaPartido` INT(11), IN `p_imagem64` TEXT, IN `p_biografia` TEXT)  NO SQL
BEGIN
	IF p_codCandidato = 0 THEN
	INSERT INTO 		candidato 
						(nomeCandidato
                        ,dtNascto
                        ,legendaPartido
                        ,caminhoImagem
                        ,biografia
                        ,ativo) 	
                        
    values				(p_nome,
						p_dataNascimento
                        ,p_legendaPartido
                        ,p_imagem64
                        ,p_biografia
                        ,'1');    
	ELSE
	UPDATE 	candidato 
    set 		nomeCandidato = p_nome, 
				dtNascto = p_dataNascimento, 
                legendaPartido = p_legendaPartido,
				caminhoImagem = p_imagem64,
				biografia = p_biografia
	WHERE 		codCandidato = p_codCandidato;    
	END IF;
    select 'true' as status;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `procCadastraProposta` (IN `p_numProposta` INT(11), IN `p_descricaoProposta` TEXT, IN `p_imagemProposta` TEXT, IN `p_codCandidato` INT(11))  BEGIN
	IF p_numProposta  = 0 THEN
		INSERT INTO proposta (descricaoProposta
							,imagemProposta
                            ,codCandidato
                            ,ativo)
		VALUES				(p_descricaoProposta
							,p_imagemProposta
                            ,p_codCandidato
                            ,1);
    ELSE
		UPDATE proposta	SET	descricaoProposta = p_descricaoProposta
							,imagemProposta = p_imagemProposta
                            ,codCandidato = p_codCandidato
		WHERE				numProposta = p_numProposta;						
    END IF;
    SELECT 'true'     as status;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `procCadastroLogErro` (IN `p_dataErro` DATE, IN `p_descricaoErro` INT(100))  NO SQL
insert into logerro VALUES(dataErro,descricaoErro)$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `procCadastroNoticia` (IN `p_codCandidato` INT(19), IN `p_fonte` VARCHAR(500), IN `p_legendaPartido` INT(19), IN `p_numNoticia` INT(19), IN `p_texto` VARCHAR(500), IN `p_titulo` VARCHAR(500), IN `p_imagem` TEXT, IN `p_autor` VARCHAR(255))  NO SQL
BEGIN
	IF p_codCandidato = 0 THEN
		SET p_codCandidato = null;
    END IF;
    
	IF p_legendaPartido = 0 THEN
		SET p_legendaPartido = null;
    END IF;

	IF p_numNoticia = 0 THEN
	insert into 	noticia (titulo
							,dtNoticia
							,texto
							,fonte
							,codCandidato
							,legendaPartido
							,caminhoImagem
							,autor
							,ativo)                                
									
		values 				(p_titulo							
							,NOW()
                            ,p_texto
                            ,p_fonte
                            ,p_codCandidato
                            ,p_legendaPartido
                            ,p_imagem
                            ,p_autor
                            ,1);                            
	ELSE
	update noticia set 	titulo = p_titulo
						,dtNoticia = NOW()
                        ,texto = p_texto
                        ,fonte = p_fonte
                        ,codCandidato = p_codCandidato
                        ,legendaPartido = p_legendaPartido
                        ,caminhoImagem = p_imagem
                        ,autor = p_autor
	where				numNoticia = p_numNoticia;
	END IF;
	select 'true' as status;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `procCadastroPartido` (IN `p_legendaPartido` INT(11), IN `p_nomePartido` VARCHAR(255), IN `p_caminhoImagemPartido` TEXT)  BEGIN
	IF p_legendaPartido = 0 THEN
		insert into partido (nomePartido
							,caminhoImagemPartido
                            ,ativo)
		
        values				(p_nomePartido
							,p_caminhoImagemPartido
                            ,1);
    ELSE
    update partido set 		nomePartido = p_nomePartido
							,caminhoImagemPartido = p_caminhoImagemPartido
	where					legendaPartido = p_legendaPartido;
    END IF;
    select 'true' as status;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `procCadastroUsuario` (IN `p_nomeUsuario` VARCHAR(100), IN `p_email` VARCHAR(100), IN `p_senha` VARCHAR(50), IN `p_idUsuario` INT(11))  NO SQL
BEGIN
IF p_idUsuario = 0 THEN
INSERT INTO usuarios (nomeUsuario,email,senha,ativo) VALUES(p_nomeUsuario,p_email,p_senha,1);
ELSE
UPDATE usuarios SET nomeUsuario = p_nomeUsuario, email = p_email, senha =p_senha WHERE idUsuario =  p_idUsuario;
END IF;
select 'true' as status;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `procDeleteCandidato` (IN `p_codCandidato` INT(11))  BEGIN
	UPDATE candidato set ativo = 0 WHERE codCandidato = p_codCandidato;
    select 'true' as status;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `procDeleteNoticia` (IN `p_numNoticia` INT(11))  BEGIN
	update 		noticia 
    SET 		ativo = 0 
    where 		numNoticia = p_numNoticia;
    select 'true' as status;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `procDeletePartido` (IN `p_legendaPartido` INT(11))  BEGIN
UPDATE partido set ativo = 0 WHERE legendaPartido = p_legendaPartido;
select 'true' as status;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `procDeleteProposta` (IN `p_numProposta` INT(11))  BEGIN
	UPDATE	proposta p set ativo = 0 where numProposta = p_numProposta;
    select 'true' as status;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `procDeleteUsuario` (IN `p_idUsuario` INT(11))  NO SQL
begin
UPDATE usuarios set ativo = 0 WHERE idUsuario = p_idUsuario;
select 'true' as status;
end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `procDropDown` (IN `p_tipo` VARCHAR(100))  BEGIN
	IF p_tipo = "partido" THEN
	select 		p.legendaPartido 	as id
				,p.nomePartido 		as texto 
                from 		partido p                 
                where ativo = 1
                order by 	p.nomePartido;
    ELSE IF p_tipo = "candidato" THEN
    select 		c.codCandidato 		as id
				,c.nomeCandidato 	as texto 
                from 				candidato 	c 
                where ativo = 1
                order by c.nomeCandidato;
	END IF;
		END IF;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `procValidaLogin` (IN `p_email` VARCHAR(150), IN `p_senha` INT(150))  NO SQL
select * from usuarios u where u.email  = p_email
and u.senha = p_senha LIMIT 1$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `procVotacao` (IN `p_codCandidato` BIGINT(19))  NO SQL
BEGIN
	IF ((SELECT COUNT(codVotacao) from votacao WHERE 	codCandidato = p_codCandidato) > 0) THEN
		update 		votacao 	
        set 		qtdVotos = qtdVotos+ 1 
        where 		codCandidato = p_codCandidato; 
	ELSE
		insert into votacao(codCandidato,qtdVotos) 
        values		(p_codCandidato
					,1);
                    
   	UPDATE candidato set codVotacao = (SELECT LAST_INSERT_ID()) WHERE 			codCandidato = p_codCandidato;             
	END IF;
    select 'true' as status;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `ValidaUsuarioCadastro` (IN `p_login` INT(100))  NO SQL
SELECT idUsuario FROM usuarios WHERE login = p_login$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `candidato`
--

CREATE TABLE `candidato` (
  `codCandidato` bigint(19) NOT NULL,
  `nomeCandidato` varchar(150) DEFAULT NULL,
  `dtNascto` datetime DEFAULT NULL,
  `legendaPartido` bigint(19) DEFAULT NULL,
  `caminhoImagem` varchar(150) DEFAULT NULL,
  `biografia` text NOT NULL,
  `ativo` int(11) NOT NULL,
  `codVotacao` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `candidato`
--

INSERT INTO `candidato` (`codCandidato`, `nomeCandidato`, `dtNascto`, `legendaPartido`, `caminhoImagem`, `biografia`, `ativo`, `codVotacao`) VALUES
(5, 'Luiz Marinho', '1959-05-20 00:00:00', 1, 'images/governadores/luiz-Marinho.png', 'Ã‰ casado com Nilza de Oliveira[1] e tem dois filhos. Bacharel em direito, foi metalÃºrgico na dÃ©cada de 1970, quando conheceu o presidente Luis InÃ¡cio Lula da Silva. Seu primeiro e Ãºnico registro em carteira Ã© de julho de 1978, data em que foi contratado para trabalhar na seÃ§Ã£o de pintura da Volkswagen de SÃ£o Bernardo do Campo (SP), onde tambÃ©m comeÃ§ou sua carreira sindical como membro da CIPA, cargo para o qual foi reeleito na gestÃ£o seguinte.Ã‰ casado com Nilza de Oliveira[1] e tem dois filhos. Bacharel em direito, foi metalÃºrgico na dÃ©cada de 1970, quando conheceu o presidente Luis InÃ¡cio Lula da Silva. Seu primeiro e Ãºnico registro em carteira Ã© de julho de 1978, data em que foi contratado para trabalhar na seÃ§Ã£o de pintura da Volkswagen de SÃ£o Bernardo do Campo (SP), onde tambÃ©m comeÃ§ou sua carreira sindical como membro da CIPA, cargo para o qual foi reeleito na gestÃ£o seguinte.Ã‰ casado com Nilza de Oliveira[1] e tem dois filhos. Bacharel em direito, foi metalÃºrgico na dÃ©cada de 1970, quando conheceu o presidente Luis InÃ¡cio Lula da Silva. Seu primeiro e Ãºnico registro em carteira Ã© de julho de 1978, data em que foi contratado para trabalhar na seÃ§Ã£o de pintura da Volkswagen de SÃ£o Bernardo do Campo (SP), onde tambÃ©m comeÃ§ou sua carreira sindical como membro da CIPA, cargo para o qual foi reeleito na gestÃ£o seguinte.Ã‰ casado com Nilza de Oliveira[1] e tem dois filhos. Bacharel em direito, foi metalÃºrgico na dÃ©cada de 1970, quando conheceu o presidente Luis InÃ¡cio Lula da Silva. Seu primeiro e Ãºnico registro em carteira Ã© de julho de 1978, data em que foi contratado para trabalhar na seÃ§Ã£o de pintura da Volkswagen de SÃ£o Bernardo do Campo (SP), onde tambÃ©m comeÃ§ou sua carreira sindical como membro da CIPA, cargo para o qual foi reeleito na gestÃ£o seguinte.Ã‰ casado com Nilza de Oliveira[1] e tem dois filhos. Bacharel em direito, foi metalÃºrgico na dÃ©cada de 1970, quando conheceu o presidente Luis InÃ¡cio Lula da Silva. Seu primeiro e Ãºnico registro em carteira Ã© de julho de 1978, data em que foi contratado para trabalhar na seÃ§Ã£o de pintura da Volkswagen de SÃ£o Bernardo do Campo (SP), onde tambÃ©m comeÃ§ou sua carreira sindical como membro da CIPA, cargo para o qual foi reeleito na gestÃ£o seguinte.Ã‰ casado com Nilza de Oliveira[1] e tem dois filhos. Bacharel em direito, foi metalÃºrgico na dÃ©cada de 1970, quando conheceu o presidente Luis InÃ¡cio Lula da Silva. Seu primeiro e Ãºnico registro em carteira Ã© de julho de 1978, data em que foi contratado para trabalhar na seÃ§Ã£o de pintura da Volkswagen de SÃ£o Bernardo do Campo (SP), onde tambÃ©m comeÃ§ou sua carreira sindical como membro da CIPA, cargo para o qual foi reeleito na gestÃ£o seguinte.Ã‰ casado com Nilza de Oliveira[1] e tem dois filhos. Bacharel em direito, foi metalÃºrgico na dÃ©cada de 1970, quando conheceu o presidente Luis InÃ¡cio Lula da Silva. Seu primeiro e Ãºnico registro em carteira Ã© de julho de 1978, data em que foi contratado para trabalhar na seÃ§Ã£o de pintura da Volkswagen de SÃ£o Bernardo do Campo (SP), onde tambÃ©m comeÃ§ou sua carreira sindical como membro da CIPA, cargo para o qual foi reeleito na gestÃ£o seguinte.', 0, 1),
(6, 'JoÃ£o Doria', '1957-12-16 00:00:00', 2, '', 'JoÃ£o Doria Jr.JoÃ£o Doria em marÃ§o de 2017.52Âº Prefeito de SÃ£o PauloPerÃ­odo1 de janeiro de 20176 de abril de 2018[1]Vice-prefeitoBruno CovasAntecessor(a)Fernando HaddadSucessor(a)Bruno CovasPresidente da EmbraturPerÃ­odo18 de marÃ§o de 1986[2]a 25 de agosto de 1988[3]PresidenteJosÃ© SarneyAntecessor(a)Joaquim Affonso Mac Dowell Leite de Castro[4]Sucessor(a)Pedro Grossi JÃºnior[5]SecretÃ¡rio Municipal de Turismo de SÃ£o PauloPerÃ­odo1983 atÃ© 1986PrefeitoMÃ¡rio CovasDados pessoaisNome completoJoÃ£o Agripino da Costa Doria JuniorNascimento16 de dezembro de 1957 (60 anos)SÃ£o Paulo, SPNacionalidadebrasileiroProgenitoresMÃ£e: Maria Sylvia de Moraes Dias DoriaPai: JoÃ£o Agripino da Costa DoriaAlma materFAAP[6]CÃ´njugeBia DoriaFilhosJoÃ£o Doria NetoPartidoPSDB (2001-presente)ReligiÃ£oCatÃ³licoOcupaÃ§Ã£oEmpresÃ¡rio, jornalista, polÃ­tico e publicitÃ¡rioFortunaR$ 179,7 milhÃµes (2016)[7]Websitejoaodoria.com.brJoÃ£o Agripino da Costa Doria Junior, mais conhecido como JoÃ£o Doria (SÃ£o Paulo, 16 de dezembro de 1957), Ã© um empresÃ¡rio, jornalista, publicitÃ¡rio e polÃ­tico brasileiro, filiado ao Partido da Social Democracia Brasileira (PSDB). Foi prefeito da cidade de SÃ£o Paulo. Ficou conhecido como entrevistador de talk-shows, palestrante e organizador de eventos empresariais. Ã‰ criador e presidente licenciado do Grupo Doria.', 0, 0),
(7, 'Celso Russomano', '1956-08-20 00:00:00', 3, 'images/governadores/CELSO-RUSSOMANNO.png', 'Teste Russo', 0, 2),
(8, 'Carlos Giannazi', '1961-12-15 00:00:00', 4, 'images\\Governadores\\carlos-giannazi.png', 'Diretor de escola pÃºblica, mestre em HistÃ³ria e Filosofia da EducaÃ§Ã£o e Doutor em HistÃ³ria EconÃ´mica pela Universidade de SÃ£o Paulo, Giannazi tambÃ©m foi professor universitÃ¡rio e vereador da cidade de SÃ£o Paulo em duas legislaturas (2000 a 2007). Como parlamentar atuou na defesa do magistÃ©rio, da educaÃ§Ã£o pÃºblica e da cidadania, junto aos movimentos sociais e a sociedade civil.Ã‰ membro titular da ComissÃ£o de EducaÃ§Ã£o e coordena as Frentes Parlamentares em defesa da escola pÃºblica, dos mÃºsicos contra a OMB, contra os pedÃ¡gios e da diversidade sexual. Ã‰ autor dos requerimentos de instalaÃ§Ã£o das CPIs da EducaÃ§Ã£o, da SeguranÃ§a PÃºblica, do JudiciÃ¡rio e do Departamento de PerÃ­cias MÃ©dicas do Estado (DPME).', 1, 1),
(9, 'MÃ¡rcio FranÃ§a', '1963-06-23 00:00:00', 5, 'images/governadores/marcio-franÃ§a.png', 'Na faculdade de direito da Universidade CatÃ³lica de Santos, MÃ¡rcio FranÃ§a comeÃ§ou sua vida pÃºblica como lÃ­der estudantil. Mais tarde, tornou-se oficial de justiÃ§a de Santos e se filiou ao Ãºnico partido de sua carreira, o Partido Socialista Brasileiro em 1988[1][2], sendo eleito vereador de SÃ£o Vicente por duas vezes e tambÃ©m prefeito da cidade por dois mandatos (1997â€“2000 e 2001â€“2004). Foi tambÃ©m eleito duas vezes deputado federal por SÃ£o Paulo (2006 e em 2010).[3]MÃ¡rcio FranÃ§a em evento da AgriShow.Em dezembro de 2010, foi convidado pelo governador eleito de SÃ£o Paulo, Geraldo Alckmin, para ser o SecretÃ¡rio de Turismo do Estado.[4]MÃ¡rcio FranÃ§a obteve a maior reeleiÃ§Ã£o para prefeito do Brasil, em 2000 (em cidades com mais de 100 mil habitantes), quando alcanÃ§ou o percentual de 91,3% dos votos vÃ¡lidos em SÃ£o Vicente. Sua gestÃ£o foi marcada por obras de infraestrutura e de valorizaÃ§Ã£o da autoestima da populaÃ§Ã£o, com destaque para a realizaÃ§Ã£o do maior espetÃ¡culo teatral em areia de praia do mundo, a EncenaÃ§Ã£o da FundaÃ§Ã£o da Vila de SÃ£o Vicente, com mil atores do povo, alÃ©m de estrelas televisivas.TambÃ©m foi o primeiro presidente do Conselho de Desenvolvimento da RegiÃ£o Metropolitana da Baixada Santista (Condesb).MÃ¡rcio FranÃ§a foi lÃ­der do PSB na CÃ¢mara dos Deputados e tambÃ©m de um bloco com 78 parlamentares. Sua atuaÃ§Ã£o lhe incluiu na relaÃ§Ã£o dos deputados mais influentes pelo DIAP. [5]Teve participaÃ§Ã£o direta em duas campanhas presidenciais, em 2002, e depois em 2014, tendo sido a primeira ao lado de Ciro Gomes [6] e a segunda ao lado de Eduardo Campos, esta Ãºltima interrompida pela morte do candidato.Como secretÃ¡rio de Turismo do Estado de SÃ£o Paulo, criou programas de inclusÃ£o turÃ­stica, como o Roda SÃ£o Paulo (Ã´nibus que fazem roteiros a preÃ§os populares), o Festival GastronÃ´mico Sabor SP o programa de caminhada chamado Passos dos JesuÃ­tas, entre outros.Como secretÃ¡rio de Desenvolvimento EconÃ´mico, CiÃªncia, Tecnologia e InovaÃ§Ã£o, incentivou a Economia Criativa; criou programa de incremento Ã  exportaÃ§Ã£o para as pequenas e mÃ©dias empresas; criou o Mercado SP para os produtos rurais paulistas, alÃ©m de incrementar os parques tecnolÃ³gicos; programas de arranjos produtivos locais, entre outros. Sua pasta comandava grandes universidades, como USP, UNICAMP, Unesp, alÃ©m do Centro Paula Souza.', 1, 2),
(10, 'Luiz Marinho', '1959-05-20 00:00:00', 1, 'images\\governadores/luiz-Marinho.png', 'Ã‰ casado com Nilza de Oliveira e tem dois filhos. Bacharel em direito, foi metalÃºrgico na dÃ©cada de 1970, quando conheceu o presidente Luis InÃ¡cio Lula da Silva. Seu primeiro e Ãºnico registro em carteira Ã© de julho de 1978, data em que foi contratado para trabalhar na seÃ§Ã£o de pintura da Volkswagen de SÃ£o Bernardo do Campo (SP), onde tambÃ©m comeÃ§ou sua carreira sindical como membro da CIPA, cargo para o qual foi reeleito na gestÃ£o seguinte.', 1, 3),
(11, 'Rodrigo Garcia', '1974-05-10 00:00:00', 6, 'images/governadores/rodrigo-garcia.png', 'Rodrigo Garcia, nasceu em Tanabi, SÃ£o Paulo, Ã© um advogado, empresÃ¡rio, corretor de imÃ³veis e polÃ­tico brasileiro. Foi deputado estadual eleito por trÃªs legislaturas consecutivas, 1999-2002, 2003-2006 e 2007-2010, e presidente da Assembleia Legislativa de SÃ£o Paulo, de 15 de marÃ§o de 2005 a 15 de marÃ§o de 2007. Licenciou-se do cargo de deputado para estar Ã  frente da Secretaria Municipal de ModernizaÃ§Ã£o, GestÃ£o e DesburocratizaÃ§Ã£o da Prefeitura de SÃ£o Paulo, de 2008 a 2010. Em abril de 2010, voltou Ã  Assembleia Legislativa para dar continuidade aos seus trabalhos como deputado estadual pelo DEM-SP.', 1, 4),
(12, 'Joao Doria', '1957-12-16 00:00:00', 2, 'images/governadores/JoÃ£o-doria.png', 'Doria Ã© um empresÃ¡rio, jornalista, publicitÃ¡rio e polÃ­tico brasileiro, filiado ao Partido da Social Democracia Brasileira (PSDB). Foi prefeito da cidade de SÃ£o Paulo. Ficou conhecido como entrevistador de talk-shows, palestrante e organizador de eventos empresariais. Ã‰ criador e presidente licenciado do Grupo Doria. Em 2012, foi eleito uma das 100 pessoas mais influentes do Brasil, segundo a revista IstoÃ©.[8] Em 2016, foi escolhido para ser o candidato do PSDB para concorrer Ã  Prefeitura Municipal de SÃ£o Paulo nas eleiÃ§Ãµes de 2016.[9] Em 2 de outubro do mesmo ano, foi eleito prefeito da cidade de SÃ£o Paulo no primeiro turno, fato inÃ©dito na histÃ³ria da cidade desde 1992, quando foram realizadas as primeiras eleiÃ§Ãµes municipais em dois turnos no Brasil.', 1, 5),
(13, 'Paulo AntÃ´nio Skaf', '1955-08-07 00:00:00', 7, 'images/governadores/paulo-skaf.png', 'Paulo Skaf Ã© empresÃ¡rio, presidente da FederaÃ§Ã£o das IndÃºstrias do Estado de SÃ£o Paulo (Fiesp), do Centro das IndÃºstrias do Estado de SÃ£o Paulo (Ciesp), do ServiÃ§o Social da IndÃºstria (Sesi-SP), do ServiÃ§o Nacional de Aprendizagem Industrial (Senai-SP), do Instituto Roberto Simonsen (IRS) e do ServiÃ§o Brasileiro de Apoio Ã s Micro e Pequenas Empresas (Sebrae/SP). Ã‰ tambÃ©m o 1Âº vice-presidente da ConfederaÃ§Ã£o Nacional da IndÃºstria (CNI). Sempre foi atuante em entidades empresariais da indÃºstria, como a ConfederaÃ§Ã£o Nacional da IndÃºstria (CNI), o Sindicato das IndÃºstrias de FiaÃ§Ã£o e Tecelagem do Estado de SÃ£o Paulo (SinditÃªxtil) e a AssociaÃ§Ã£o Brasileira da IndÃºstria TÃªxtil e de ConfecÃ§Ã£o (ABIT', 1, 6);

-- --------------------------------------------------------

--
-- Estrutura da tabela `logerro`
--

CREATE TABLE `logerro` (
  `idLog` bigint(19) NOT NULL,
  `dataErro` datetime DEFAULT NULL,
  `descricaoErro` varchar(10000) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `noticia`
--

CREATE TABLE `noticia` (
  `numNoticia` bigint(19) NOT NULL,
  `titulo` varchar(1000) DEFAULT NULL,
  `dtNoticia` datetime DEFAULT NULL,
  `texto` text,
  `fonte` varchar(1000) DEFAULT NULL,
  `codCandidato` bigint(19) DEFAULT NULL,
  `legendaPartido` bigint(19) DEFAULT NULL,
  `idGoogleNews` int(11) DEFAULT NULL,
  `caminhoImagem` text,
  `autor` varchar(100) NOT NULL,
  `ativo` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `noticia`
--

INSERT INTO `noticia` (`numNoticia`, `titulo`, `dtNoticia`, `texto`, `fonte`, `codCandidato`, `legendaPartido`, `idGoogleNews`, `caminhoImagem`, `autor`, `ativo`) VALUES
(1, 'PT escolhe Luiz Marinho como candidato do partido ao governo do Estado de SP', '2018-06-07 08:37:58', 'PT definiu neste sÃ¡bado (24) o nome que vai concorrer ao governo do Estado de SÃ£o Paulo: serÃ¡ Luiz Marinho, ex-prefeito de SÃ£o Bernardo do Campo, no ABC paulista.Marinho venceu a disputa interna com cerca de 80% dos votos. Dos 1.200 delegados estaduais do partido, 896 se inscreveram para a votaÃ§Ã£o, que ocorreu na sede do Sindicato dos BancÃ¡rios, no Centro de SÃ£o Paulo.Foram 660 votos de Marinho contra 175 de ElÃ³i PietÃ¡.A votaÃ§Ã£o durou uma hora e 30 minutos. Suplicy foi aclamado como ', 'Globo.com', 5, 1, NULL, '', 'Por Bruno Tavares, SP2', 0),
(2, 'USP vai fechar creche e transferir crianÃ§as de unidade na Cidade UniversitÃ¡ria', '2018-06-13 10:34:21', 'Universidade de SÃ£o Paulo (USP) quer fechar uma das creches disponÃ­veis para filhos de alunos e funcionÃ¡rios na Cidade UniversitÃ¡ria, na Zona Oeste da capital paulista. Para â€œotimizar os espaÃ§osâ€, como justificou, a reitoria vai transferir as cerca de 70 crianÃ§as atendidas na creche Oeste e agrupÃ¡-las na unidade central, que fica no mesmo campus.A SuperintendÃªncia de AssistÃªncia Social da USP emitiu um comunicado sobre a decisÃ£o na Ãºltima segunda-feira (16) avisando que o processo', 'LUCAS', 8, 4, NULL, '', 'DESCUBRANEWS', 1),
(3, 'Alckmin envia Ã  Assembleia Plano Estadual de EducaÃ§Ã£o com 23 metas', '2018-06-13 11:31:52', 'O governador Geraldo Alckmin (PSDB) enviou Ã  Assembleia Legislativa nesta terÃ§a-feira (4) o projeto de sobre o Plano Estadual de EducaÃ§Ã£o. A proposta deveria ter sido aprovada em 24 de junho, como estabelecido pelo Plano Nacional de EducaÃ§Ã£o, sancionado em 2014.O projeto de lei 1038/2015 ainda precisa ser aprovada pelos deputados estaduais paulistas e terÃ¡ vigÃªncia de dez anos. A proposta apresenta 23 metas a serem cumpridas dentro desse prazo. Entre as propostas. estÃ¡ a inclusÃ£o de um', 'Lucas', 8, 4, NULL, '', 'DESCUBRANEWS', 1),
(4, 'HÃ¡ 5 meses sem reuniÃ£o, comissÃ£o da Assembleia de SP aprova convocaÃ§Ã£o de secretÃ¡rio de educaÃ§Ã£o', '2018-06-13 11:32:32', 'Sem atividade hÃ¡ cinco meses, a ComissÃ£o de EducaÃ§Ã£o e Cultura da Assembleia Legislativa do estado de SÃ£o Paulo aprovou nesta quarta-feira (22), a convocaÃ§Ã£o do secretÃ¡rio estadual de EducaÃ§Ã£o, JoÃ£o Curi Neto.Pelo regimento a comissÃ£o de EducaÃ§Ã£o e Cultura, uma das 16 permanentes na Casa, deveria acontecer semanalmente.O requerimento tinha sido feito pelo deputado Carlos Giannazi (PSOL) no ano passado, quando a pasta era comandada por JosÃ© Renato Nalini.Durante a reuniÃ£o, Giannaz', 'Lucas', 8, 4, NULL, '', 'DESCUBRANEWS', 1),
(5, 'PSOL lanÃ§a prÃ©-candidatura de Basile Christopolous ao governo de Alagoas', '2018-06-13 12:36:08', 'A prÃ©-candidatura ao governo de Alagoas do professor Basile Christopolous pelo Partido Socialismo e Liberdade (PSOL) foi lanÃ§ada oficialmente nesta terÃ§a-feira (15), em uma entrevista coletiva Ã  imprensa em um hotel na Ponta Verde, em MaceiÃ³.Doutor em direito pela Universidade de SÃ£o Paulo (USP), Basile Georges Campos Christopoulos Ã© professor da Universidade Federal da ParaÃ­ba (UFPB) e da Faculdade SEUNE, em MaceiÃ³.Durante o lanÃ§amento da prÃ©-candidatura, Christopolous afirmou que o ', 'Lucas', 13, NULL, NULL, 'images/psol.png', 'Descubranews', 0),
(6, 'MÃ¡rcio FranÃ§a Ã© um homem otimista.', '2018-06-13 11:36:14', 'HÃ¡ dois meses, o governador de SÃ£o Paulo apresentou um plano detalhado a um deputado de como ele planejava decolar sua candidatura. FranÃ§a queria que o polÃ­tico topasse migrar para o PSB.â€œHoje ninguÃ©m me conhece, mas em trinta diasâ€¦â€, teria dito.JÃ¡ se passaram quase sessenta e nada aconteceu, mas nem por isso FranÃ§a desistiu. O plano dele passa pela conquista do servidor pÃºblico em SÃ£o Paulo. Segue vendendo promessas.E o sentimento Ã© que, ao menos aos policiais militares, o flert', 'Lucas', 9, 5, NULL, '', 'Descubranews', 1),
(7, 'MÃ¡rcio FranÃ§a deu sinais confusos na resoluÃ§Ã£o da greve', '2018-06-13 11:38:12', 'Foi difÃ­cil prever os passos de MÃ¡rcio FranÃ§a (PSB) frente a paralisaÃ§Ã£o dos caminhoneiros.Na quinta-feira (24), o governador de SÃ£o Paulo disse que a greve era assunto de Michel Temer. No dia seguinte, disse que a PolÃ­cia RodoviÃ¡ria passaria a multar imediatamente os caminhÃµes que interromperem o trÃ¢nsito.Durou pouco. Logo no sÃ¡bado, apÃ³s negociaÃ§Ãµes com representantes da classe, FranÃ§a anunciou a anulaÃ§Ã£o das multas aplicadas aos caminhoneiros.No domingo, o presidente nacional', 'Lucas', 9, 5, NULL, 'images/Marcio-Franca.jpg', 'DescubraNews', 1),
(8, 'SP comeÃ§a a ter um pouco de normalidade, diz MÃ¡rcio FranÃ§a sobre postos', '2018-06-13 11:38:56', 'Foi difÃ­cil prever os passos de MÃ¡rcio FranÃ§a (PSB) frente a paralisaÃ§Ã£o dos caminhoneiros.Na quinta-feira (24), o governador de SÃ£o Paulo disse que a greve era assunto de Michel Temer. No dia seguinte, disse que a PolÃ­cia RodoviÃ¡ria passaria a multar imediatamente os caminhÃµes que interromperem o trÃ¢nsito.Durou pouco. Logo no sÃ¡bado, apÃ³s negociaÃ§Ãµes com representantes da classe, FranÃ§a anunciou a anulaÃ§Ã£o das multas aplicadas aos caminhoneiros.No domingo, o presidente nacional', 'Lucas', 9, 5, NULL, '', 'Descubranews', 1),
(9, 'CÃºpula do PSB estava em alerta com comportamento distante de Barbosa', '2018-06-13 11:39:21', 'Apesar de vir mostrando bom desempenho nas pesquisas eleitorais, Joaquim Barbosa causava grande preocupaÃ§Ã£o dentro do PSB pelo comportamento avesso Ã  polÃ­tica, informa o repÃ³rter Nilson Klava, da GloboNews.Integrantes da cÃºpula da legenda jÃ¡ estavam em alerta com o distanciamento permanente do ex-ministro do Supremo Tribunal Federal com relaÃ§Ã£o Ã  legenda, o que provocava apreensÃ£o sobre a determinaÃ§Ã£o da candidatura.Na primeira reuniÃ£o polÃ­tica que teve na sede do partido, em abri', 'Lucas', NULL, 5, NULL, '', 'Descubranews', 0),
(10, 'Presidente do PSB aposta em Haddad para substituir Lula na eleiÃ§Ã£o', '2018-06-13 11:39:42', 'Presidente nacional do PSB, Carlos Siqueira afirmou que hÃ¡ â€œvÃ¡rios interessadosâ€ em contar com o apoio da legenda nas eleiÃ§Ãµes de 2018, depois que Joaquim Barbosa, ex-presidente do Supremo Tribunal Federal (STF), desistiu de disputar o Planalto. Siqueira colocou o partido mais prÃ³ximo de uma alianÃ§a Ã  esquerda, com o PT ou o PDT, e disse nÃ£o haver â€œclima favorÃ¡velâ€ para apoiar a ex-senadora Marina Silva, que concorreu em 2014 pelo PSB e hoje estÃ¡ na Rede.â€œNunca dissemos sim o', 'Lucas', NULL, 5, NULL, '', 'Descubranews', 0),
(11, '\'Ã‰ preciso planejar para resolver\", diz Luiz Marinho', '2018-06-13 11:42:29', 'Em entrevista ao Metro Jornal, prÃ©-candidato do PT afirma que sua experiÃªncia Ã  frente da Prefeitura de SÃ£o Bernardo serve como laboratÃ³rio para governar o estado Ex-prefeito de SÃ£o Bernardo, ex-ministro no governo Lula e uma das pessoas mais prÃ³ximas do ex-presidente, traz de sua experiÃªncia na prefeitura a necessidade de diagnosticar os problemas para planejar sua soluÃ§Ã£o, o que pretende fazer no estado. Leia trechos de sua entrevista ao Metro Jornal. Qual Ã© hoje o maior problema do', 'AndrÃ© Porto/ Metro', 10, NULL, NULL, '', 'Por Metro Jorna', 1),
(12, 'O candidato encrencado de Lula', '2018-06-13 12:22:39', 'Durante a gestÃ£o de Luiz Marinho Ã  frente da prefeitura de SÃ£o Bernardo do Campo, a OAS recebeu R$ 1 bilhÃ£o, fruto de um grande esquema de corrupÃ§Ã£o, com licitaÃ§Ãµes dirigidas e obras superfaturadas, que envolveu o ex-presidente Lula e o entÃ£o sÃ³cio da empreiteira LÃ©o Pinheiro. A OAS, uma das cinco maiores empreiteiras do Brasil, nÃ£o apenas brindou o ex-presidente Lula com um trÃ­plex no GuarujÃ¡. Nem somente atuou como uma espÃ©cie de mestre-de-obras da reforma do sÃ­tio do petista e', 'EDIÃ‡ÃƒO NÂº2529 08/06', 10, NULL, NULL, 'images/luizmarinholula.jpg', 'Isto Ã©', 1),
(13, 'NÃ£o sou carreirista e quero continuar sendo gestor, afirma Doria', '2018-06-13 12:32:00', 'PrÃ©-candidato do PSDB ao governo de SÃ£o Paulo, o ex-prefeito JoÃ£o Doria afirmou que â€œnÃ£o hÃ¡ plano Bâ€ no partido para a disputa presidencial e reforÃ§ou que o candidato tucano Ã© o ex-governador Geraldo Alckmin, que deve aglutinar as forÃ§as de centro. Segundo ele, o ex-governador paulista e presidenciÃ¡vel tucano nÃ£o precisa de conselhos, mas de â€œapoio e votosâ€. O ex-prefeito afirmou ainda nÃ£o ser \"carreirista\", apÃ³s ter deixado o governo municipal com15 meses de gestÃ£o e de ter', 'Valor', 12, 2, NULL, '', 'Por Cristiane Agostine', 1),
(14, 'JoÃ£o Doria deixa a prefeitura de SÃ£o Paulo nesta sexta (6) e vice Bruno Covas assume', '2018-06-13 12:32:21', 'Em seu primeiro ano de governo, JoÃ£o Doria (PSDB) cumpriu 12 das 80 promessas de campanha. Em 2016, ele disse ao G1 que ficaria no cargo atÃ© o final do mandato. Por G1 SP06/04/2018 15h26 Atualizado 06/04/2018 20h47 O prefeito JoÃ£o Doria (PSDB) deixou a Prefeitura da capital paulista na tarde desta sexta-feira (6), apÃ³s um ano e trÃªs meses Ã  frente do cargo em cerimÃ´nia na sede da administraÃ§Ã£o municipal, no Centro. Ele deixou o cargo para poder disputar candidatura pelo governo do estad', 'Mayara', NULL, NULL, NULL, '', 'Descubranews', 1),
(15, 'Mais da metade das metas do programa de governo de Doria nÃ£o tem resultados positivos, aponta pesquisa', '2018-06-13 12:32:45', 'Segundo balanÃ§o da Rede Nossa SP, das 53 metas, 4 foram cumpridas, 20 foram iniciadas e outras 29 nÃ£o tiveram resultados nos 12 primeiros meses de governo.No primeiro ano da gestÃ£o do ex-prefeito de SÃ£o Paulo JoÃ£o Doria (PSDB), mais da metade das promessas de governo contidas no Programa de Metas 2017-2020 nÃ£o apresentou resultados positivos, segundo balanÃ§o parcial divulgado nesta terÃ§a-feira (17) pela Rede Nossa SÃ£o Paulo. Das 53 metas, 4 foram cumpridas e 20 foram iniciadas, de acord', 'Mayara', 12, NULL, NULL, '', 'DescubraNews', 1),
(16, 'MDB oficializa prÃ©-candidatura de Paulo Skaf ao governo de SÃ£o Paulo', '2018-06-13 12:34:15', 'O MDB oficializou neste sÃ¡bado (5) a prÃ©-candidatura do presidente da FederaÃ§Ã£o das IndÃºstrias de SÃ£o Paulo (Fiesp), Paulo Skaf, ao governo de SP. O evento ocorreu em JaguariÃºna (SP), na regiÃ£o de Campinas (SP). O anÃºncio foi feito durante o encontro estadual do partido, que reuniu cerca de mil pessoas. ComeÃ§ou Ã s 11h, com uma hora de atraso, e o presidente da RepÃºblica, Michel Temer, participou do evento, que tambÃ©m apresentou os prÃ©-candidatos a deputado estadual, a deputado fede', 'Mayara', 13, NULL, NULL, '', 'DescubraNews', 1),
(17, 'PrÃ©-candidato do MDB ao governo paulista, Paulo Skaf', '2018-06-13 12:37:59', 'JOELMIR TAVARES\"NÃ£o Ã© fato. Nem conheÃ§o pessoalmente o candidato Bolsonaro\", afirmou ele ao participar nesta sexta-feira (8) da sÃ©rie de sabatinas promovidas por Folha de S.Paulo, UOL e SBT. O presidente licenciado da Fiesp (FederaÃ§Ã£o das IndÃºstrias do Estado de SÃ£o Paulo) afastou a possibilidade de dar palanque para Bolsonaro no estado. Skaf disse que seu candidato na eleiÃ§Ã£o presidencial Ã© o mesmo de seu partido, o ex-ministro Henrique Meirelles. \"Tenho respeito por ele [Bolsonaro],', 'Mayara', 13, NULL, NULL, '', 'DescubraNews', 1),
(18, 'Governo de SP: Skaf exagera rejeiÃ§Ã£o a Doria e erra ao lembrar campanha de 2014', '2018-06-13 12:35:15', 'â€œO TRE [de SÃ£o Paulo] aprovou minhas contas [da eleiÃ§Ã£o de 2014] sem ressalvasâ€ Dados disponÃ­veis no Tribunal Regional Eleitoral de SÃ£o Paulo mostram que as contas da campanha de Paulo Skaf em 2014 foram aprovadas â€œcom ressalvasâ€ â€“ diferente do que ele afirmou na sabatina. Publicada em abril de 2016, a decisÃ£o do TRE indica divergÃªncias entre a prestaÃ§Ã£o de contas final, feita ao tÃ©rmino da campanha, e a parcial, apresentadadurante a corrida eleitoral. Houve 18 doaÃ§Ãµes que ', 'Mayara', 13, NULL, NULL, '', 'LEANDRO RESENDE E NATHÃLIA AFONSO', 1),
(19, 'TÃ­tulo de eleitor: documento deve estar em dia atÃ© 9 de maio', '2018-06-13 12:39:00', 'RejeiÃ§Ã£o na pesquisa Ibope para governador de SP O Ibope mostrou tambÃ©m que Doria e Skaf tambÃ©m lideram os Ã­ndices de rejeiÃ§Ã£o. Segundo o levantamento, 33% dos eleitores nÃ£o votariam de jeito nenhum no prefeito da capital, enquanto 32% se recusam a votar no presidente da Fiesp, que jÃ¡ concorreu a governador nas eleiÃ§Ãµes de 2010 e 2014, quando teve o melhor desempenho (segundo lugar com 21% dos votos vÃ¡lidos). Resultado da pesquisa Ibope para governador de SP deve ser novo obstÃ¡culo ', 'May', NULL, NULL, NULL, 'images/regular.jpg', 'DescubraNews', 1),
(20, 'EleiÃ§Ãµes 2018: veja quais sÃ£o os provÃ¡veis candidatos a governador de SP', '2018-06-13 12:40:25', 'A disputa entre Doria e Skaf fica ainda mais acirrada em um eventual segundo turno. Segundo o Ibope, ambos alcanÃ§am 32% das intenÃ§Ãµes de voto. Na simulaÃ§Ã£o entre Doria e FranÃ§a, o tucano venceria com 39% dos votos ante 20% do atual governador. Doria tambÃ©m ganharia de Luiz Marinho com 41% contra 21% na projeÃ§Ã£o de segundo turno. A Ãºltima eleiÃ§Ã£o a governador decidida no segundo turno foi em 2002, quando Geraldo Alckmin (PSDB) superou JosÃ© Genoino (PT).', 'DescubraNews', NULL, NULL, NULL, 'images/brasil.jpg', 'DescubraNews', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `partido`
--

CREATE TABLE `partido` (
  `legendaPartido` bigint(19) NOT NULL,
  `nomePartido` varchar(150) DEFAULT NULL,
  `caminhoImagemPartido` varchar(250) DEFAULT NULL,
  `ativo` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `partido`
--

INSERT INTO `partido` (`legendaPartido`, `nomePartido`, `caminhoImagemPartido`, `ativo`) VALUES
(1, 'PT', '', 1),
(2, 'PSDB', '', 1),
(3, 'PRB', '', 0),
(4, 'PSOL', '', 1),
(5, 'PSB', '', 1),
(6, 'DEMOCRATAS', '', 1),
(7, 'PMDB', '', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `proposta`
--

CREATE TABLE `proposta` (
  `numProposta` bigint(19) NOT NULL,
  `descricaoProposta` varchar(10000) DEFAULT NULL,
  `imagemProposta` varchar(250) DEFAULT NULL,
  `codCandidato` bigint(19) DEFAULT NULL,
  `ativo` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `proposta`
--

INSERT INTO `proposta` (`numProposta`, `descricaoProposta`, `imagemProposta`, `codCandidato`, `ativo`) VALUES
(1, 'Lorem Ipsum Ã© simplesmente uma simulaÃ§Ã£o de texto da indÃºstria tipogrÃ¡fica e de impressos, e vem sendo utilizado desde o sÃ©culo XVI, quando um impressor desconhecido pegou uma bandeja de tipos e os embaralhou para fazer um livro de modelos de tipos. Lorem Ipsum sobreviveu nÃ£o sÃ³ a cinco sÃ©culos, como tambÃ©m ao salto para a editoraÃ§Ã£o eletrÃ´nica, permanecendo essencialmente inalterado. Se popularizou na dÃ©cada de 60, quando a Letraset lanÃ§ou decalques contendo passagens de Lorem Ipsum, e mais recentemente quando passou a ser integrado a softwares de editoraÃ§Ã£o eletrÃ´nica como Aldus PageMaker.', '', 11, 1),
(2, 'Lorem Ipsum Ã© simplesmente uma simulaÃ§Ã£o de texto da indÃºstria tipogrÃ¡fica e de impressos, e vem sendo utilizado desde o sÃ©culo XVI, quando um impressor desconhecido pegou uma bandeja de tipos e os embaralhou para fazer um livro de modelos de tipos. Lorem Ipsum sobreviveu nÃ£o sÃ³ a cinco sÃ©culos, como tambÃ©m ao salto para a editoraÃ§Ã£o eletrÃ´nica, permanecendo essencialmente inalterado. Se popularizou na dÃ©cada de 60, quando a Letraset lanÃ§ou decalques contendo passagens de Lorem Ipsum, e mais recentemente quando passou a ser integrado a softwares de editoraÃ§Ã£o eletrÃ´nica como Aldus PageMaker.', '', 13, 1),
(3, 'Lorem Ipsum Ã© simplesmente uma simulaÃ§Ã£o de texto da indÃºstria tipogrÃ¡fica e de impressos, e vem sendo utilizado desde o sÃ©culo XVI, quando um impressor desconhecido pegou uma bandeja de tipos e os embaralhou para fazer um livro de modelos de tipos. Lorem Ipsum sobreviveu nÃ£o sÃ³ a cinco sÃ©culos, como tambÃ©m ao salto para a editoraÃ§Ã£o eletrÃ´nica, permanecendo essencialmente inalterado. Se popularizou na dÃ©cada de 60, quando a Letraset lanÃ§ou decalques contendo passagens de Lorem Ipsum, e mais recentemente quando passou a ser integrado a softwares de editoraÃ§Ã£o eletrÃ´nica como Aldus PageMaker.', '', 9, 1),
(4, 'Lorem Ipsum Ã© simplesmente uma simulaÃ§Ã£o de texto da indÃºstria tipogrÃ¡fica e de impressos, e vem sendo utilizado desde o sÃ©culo XVI, quando um impressor desconhecido pegou uma bandeja de tipos e os embaralhou para fazer um livro de modelos de tipos. Lorem Ipsum sobreviveu nÃ£o sÃ³ a cinco sÃ©culos, como tambÃ©m ao salto para a editoraÃ§Ã£o eletrÃ´nica, permanecendo essencialmente inalterado. Se popularizou na dÃ©cada de 60, quando a Letraset lanÃ§ou decalques contendo passagens de Lorem Ipsum, e mais recentemente quando passou a ser integrado a softwares de editoraÃ§Ã£o eletrÃ´nica como Aldus PageMaker.', '', 10, 1),
(5, 'Lorem Ipsum Ã© simplesmente uma simulaÃ§Ã£o de texto da indÃºstria tipogrÃ¡fica e de impressos, e vem sendo utilizado desde o sÃ©culo XVI, quando um impressor desconhecido pegou uma bandeja de tipos e os embaralhou para fazer um livro de modelos de tipos. Lorem Ipsum sobreviveu nÃ£o sÃ³ a cinco sÃ©culos, como tambÃ©m ao salto para a editoraÃ§Ã£o eletrÃ´nica, permanecendo essencialmente inalterado. Se popularizou na dÃ©cada de 60, quando a Letraset lanÃ§ou decalques contendo passagens de Lorem Ipsum, e mais recentemente quando passou a ser integrado a softwares de editoraÃ§Ã£o eletrÃ´nica como Aldus PageMaker.', '', 12, 1),
(6, 'Lorem Ipsum Ã© simplesmente uma simulaÃ§Ã£o de texto da indÃºstria tipogrÃ¡fica e de impressos, e vem sendo utilizado desde o sÃ©culo XVI, quando um impressor desconhecido pegou uma bandeja de tipos e os embaralhou para fazer um livro de modelos de tipos. Lorem Ipsum sobreviveu nÃ£o sÃ³ a cinco sÃ©culos, como tambÃ©m ao salto para a editoraÃ§Ã£o eletrÃ´nica, permanecendo essencialmente inalterado. Se popularizou na dÃ©cada de 60, quando a Letraset lanÃ§ou decalques contendo passagens de Lorem Ipsum, e mais recentemente quando passou a ser integrado a softwares de editoraÃ§Ã£o eletrÃ´nica como Aldus PageMaker.', '', 8, 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuarios`
--

CREATE TABLE `usuarios` (
  `idUsuario` bigint(19) NOT NULL,
  `nomeUsuario` varchar(150) DEFAULT NULL,
  `email` varchar(150) DEFAULT NULL,
  `senha` varchar(150) DEFAULT NULL,
  `ativo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `usuarios`
--

INSERT INTO `usuarios` (`idUsuario`, `nomeUsuario`, `email`, `senha`, `ativo`) VALUES
(22, 'Guilherme', 'guilherme19988@hotmail.com', 'ODE4ZWI1OTljMzRiNmE1NDFmYzlmYTExYmU0ZTg3MDE=', 1),
(24, 'teste', 'teste', 'YzAyNzJhYzg0YzQ3Mzk2MGM2Y2MwZTBkZTMyMDE2ZTE=', 0);

-- --------------------------------------------------------

--
-- Estrutura da tabela `votacao`
--

CREATE TABLE `votacao` (
  `codCandidato` bigint(19) DEFAULT NULL,
  `qtdVotos` int(11) DEFAULT NULL,
  `codVotacao` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `votacao`
--

INSERT INTO `votacao` (`codCandidato`, `qtdVotos`, `codVotacao`) VALUES
(8, 2, 1),
(9, 1, 2),
(10, 1, 3),
(11, 1, 4),
(12, 1, 5),
(13, 1, 6);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `candidato`
--
ALTER TABLE `candidato`
  ADD PRIMARY KEY (`codCandidato`),
  ADD KEY `partido_legendapartidofk` (`legendaPartido`);

--
-- Indexes for table `logerro`
--
ALTER TABLE `logerro`
  ADD PRIMARY KEY (`idLog`);

--
-- Indexes for table `noticia`
--
ALTER TABLE `noticia`
  ADD PRIMARY KEY (`numNoticia`),
  ADD KEY `codcandidato_candidato` (`codCandidato`),
  ADD KEY `legendapartido_partido` (`legendaPartido`);

--
-- Indexes for table `partido`
--
ALTER TABLE `partido`
  ADD PRIMARY KEY (`legendaPartido`);

--
-- Indexes for table `proposta`
--
ALTER TABLE `proposta`
  ADD PRIMARY KEY (`numProposta`),
  ADD KEY `codCandidato2_candidatofk` (`codCandidato`);

--
-- Indexes for table `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`idUsuario`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `votacao`
--
ALTER TABLE `votacao`
  ADD PRIMARY KEY (`codVotacao`),
  ADD KEY `codCandidato_Candidatofk` (`codCandidato`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `candidato`
--
ALTER TABLE `candidato`
  MODIFY `codCandidato` bigint(19) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `logerro`
--
ALTER TABLE `logerro`
  MODIFY `idLog` bigint(19) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `noticia`
--
ALTER TABLE `noticia`
  MODIFY `numNoticia` bigint(19) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT for table `partido`
--
ALTER TABLE `partido`
  MODIFY `legendaPartido` bigint(19) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `proposta`
--
ALTER TABLE `proposta`
  MODIFY `numProposta` bigint(19) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `idUsuario` bigint(19) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
--
-- AUTO_INCREMENT for table `votacao`
--
ALTER TABLE `votacao`
  MODIFY `codVotacao` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- Constraints for dumped tables
--

--
-- Limitadores para a tabela `candidato`
--
ALTER TABLE `candidato`
  ADD CONSTRAINT `partido_legendapartidofk` FOREIGN KEY (`legendaPartido`) REFERENCES `partido` (`legendaPartido`);

--
-- Limitadores para a tabela `noticia`
--
ALTER TABLE `noticia`
  ADD CONSTRAINT `candidato_codCandidatoFk` FOREIGN KEY (`codCandidato`) REFERENCES `candidato` (`codCandidato`),
  ADD CONSTRAINT `codcandidato_candidato` FOREIGN KEY (`codCandidato`) REFERENCES `candidato` (`codCandidato`),
  ADD CONSTRAINT `legendapartido_partido` FOREIGN KEY (`legendaPartido`) REFERENCES `partido` (`legendaPartido`);

--
-- Limitadores para a tabela `proposta`
--
ALTER TABLE `proposta`
  ADD CONSTRAINT `codCandidato2_candidatofk` FOREIGN KEY (`codCandidato`) REFERENCES `candidato` (`codCandidato`);

--
-- Limitadores para a tabela `votacao`
--
ALTER TABLE `votacao`
  ADD CONSTRAINT `codCandidato_Candidatofk` FOREIGN KEY (`codCandidato`) REFERENCES `candidato` (`codCandidato`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
