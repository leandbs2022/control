-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Tempo de geração: 13-Maio-2021 às 19:47
-- Versão do servidor: 10.4.10-MariaDB
-- versão do PHP: 5.6.40

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `conv_control`
--
CREATE DATABASE IF NOT EXISTS `conv_control` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `conv_control`;

-- --------------------------------------------------------

--
-- Estrutura da tabela `acessos`
--

DROP TABLE IF EXISTS `acessos`;
CREATE TABLE IF NOT EXISTS `acessos` (
  `conv` text NOT NULL,
  `user` text NOT NULL,
  `pass` text NOT NULL,
  `contato` text NOT NULL,
  `guia` text NOT NULL,
  `obser` text NOT NULL,
  `link_email` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `status`
--

DROP TABLE IF EXISTS `status`;
CREATE TABLE IF NOT EXISTS `status` (
  `STATUS` text NOT NULL,
  `PACIENTE` text NOT NULL,
  `CONV` text NOT NULL,
  `MATRICULA` text NOT NULL,
  `PROC` text NOT NULL,
  `MEDICO` text NOT NULL,
  `OLHO` text NOT NULL,
  `DATA` text NOT NULL,
  `GUIA` text NOT NULL,
  `OBS` text NOT NULL,
  `id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
--
-- Banco de dados: `cst`
--
CREATE DATABASE IF NOT EXISTS `cst` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `cst`;

-- --------------------------------------------------------

--
-- Estrutura da tabela `aut_conv`
--

DROP TABLE IF EXISTS `aut_conv`;
CREATE TABLE IF NOT EXISTS `aut_conv` (
  `conv` text DEFAULT NULL,
  `aut` text DEFAULT NULL,
  `meio_aut` text DEFAULT NULL,
  `cont_conv` text DEFAULT NULL,
  `guia` text DEFAULT NULL,
  `oct` text DEFAULT NULL,
  `oct_yag` text DEFAULT NULL,
  `perf` int(2) NOT NULL,
  PRIMARY KEY (`perf`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `base`
--

DROP TABLE IF EXISTS `base`;
CREATE TABLE IF NOT EXISTS `base` (
  `nome` varchar(25) NOT NULL,
  `descri` text NOT NULL,
  `data` text NOT NULL,
  `tipo` varchar(25) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `colab`
--

DROP TABLE IF EXISTS `colab`;
CREATE TABLE IF NOT EXISTS `colab` (
  `cnpj` int(11) NOT NULL,
  `cpf` int(11) NOT NULL,
  `valide_cnpj` int(11) NOT NULL,
  `nome` text NOT NULL,
  `area` text DEFAULT NULL,
  `sen` int(11) DEFAULT NULL,
  `dt_cad` datetime DEFAULT NULL,
  PRIMARY KEY (`cnpj`,`cpf`),
  KEY `colab_FKIndex1` (`valide_cnpj`),
  KEY `IFK_Rel_01` (`valide_cnpj`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `depart`
--

DROP TABLE IF EXISTS `depart`;
CREATE TABLE IF NOT EXISTS `depart` (
  `dep` text NOT NULL,
  `cod_dep` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`cod_dep`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `depart`
--

INSERT INTO `depart` (`dep`, `cod_dep`) VALUES
('TI', 1),
('GERENCIA', 2);

-- --------------------------------------------------------

--
-- Estrutura da tabela `equip`
--

DROP TABLE IF EXISTS `equip`;
CREATE TABLE IF NOT EXISTS `equip` (
  `Marca` text NOT NULL,
  `Modelo` text NOT NULL,
  `Conf` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `forne_terc`
--

DROP TABLE IF EXISTS `forne_terc`;
CREATE TABLE IF NOT EXISTS `forne_terc` (
  `Id` bigint(11) NOT NULL AUTO_INCREMENT,
  `emp` text NOT NULL,
  `cnpj_emp` text NOT NULL,
  `tel` text DEFAULT NULL,
  `cont` text DEFAULT NULL,
  `cel_tel` text DEFAULT NULL,
  `prod_serv` text DEFAULT NULL,
  `cep` text DEFAULT NULL,
  `logr` text DEFAULT NULL,
  `bai` text DEFAULT NULL,
  `cid` text DEFAULT NULL,
  `obs` text DEFAULT NULL,
  `ative` text NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `hist`
--

DROP TABLE IF EXISTS `hist`;
CREATE TABLE IF NOT EXISTS `hist` (
  `Usuário` text NOT NULL,
  `Tab` text NOT NULL,
  `Data` date NOT NULL,
  `campos` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `impr`
--

DROP TABLE IF EXISTS `impr`;
CREATE TABLE IF NOT EXISTS `impr` (
  `ip` text NOT NULL,
  `loc` text NOT NULL,
  `marc` text NOT NULL,
  `mode` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `impr_tonner`
--

DROP TABLE IF EXISTS `impr_tonner`;
CREATE TABLE IF NOT EXISTS `impr_tonner` (
  `ton` text NOT NULL,
  `model` text NOT NULL,
  `quant` int(11) NOT NULL,
  `loc_unid` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `infor_secret`
--

DROP TABLE IF EXISTS `infor_secret`;
CREATE TABLE IF NOT EXISTS `infor_secret` (
  `equip_prod` text NOT NULL,
  `area` text NOT NULL,
  `usuario` text NOT NULL,
  `senha` text NOT NULL,
  `dica` text NOT NULL,
  `infor_imp` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `lemb`
--

DROP TABLE IF EXISTS `lemb`;
CREATE TABLE IF NOT EXISTS `lemb` (
  `iduser` tinyint(11) NOT NULL,
  `iddep` tinyint(11) NOT NULL,
  `data` text NOT NULL,
  `descr` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `lemb`
--

INSERT INTO `lemb` (`iduser`, `iddep`, `data`, `descr`) VALUES
(1, 1, '12/05/2021', 'TESTE'),
(1, 1, '13/05/2021', 'TESTE');

-- --------------------------------------------------------

--
-- Estrutura da tabela `login`
--

DROP TABLE IF EXISTS `login`;
CREATE TABLE IF NOT EXISTS `login` (
  `Codigo` int(4) NOT NULL,
  `Nome` text NOT NULL,
  `Nivel` int(1) NOT NULL,
  `dep` int(2) NOT NULL,
  `Senha` text NOT NULL,
  KEY `Codigo` (`Codigo`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `login`
--

INSERT INTO `login` (`Codigo`, `Nome`, `Nivel`, `dep`, `Senha`) VALUES
(1, 'Leandro', 2, 1, 'MTQ0MzEwNg==');

-- --------------------------------------------------------

--
-- Estrutura da tabela `nf_prev`
--

DROP TABLE IF EXISTS `nf_prev`;
CREATE TABLE IF NOT EXISTS `nf_prev` (
  `id_nf` bigint(20) NOT NULL,
  `cnpj` bigint(20) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `prev`
--

DROP TABLE IF EXISTS `prev`;
CREATE TABLE IF NOT EXISTS `prev` (
  `descri` text NOT NULL,
  `data` date NOT NULL,
  `obs` text NOT NULL,
  `cnpj` bigint(20) NOT NULL,
  `id_nf` bigint(20) DEFAULT NULL,
  `Valor` text DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `red_tel`
--

DROP TABLE IF EXISTS `red_tel`;
CREATE TABLE IF NOT EXISTS `red_tel` (
  `ip` text NOT NULL,
  `host` text DEFAULT NULL,
  `dep` text NOT NULL,
  `resp` text NOT NULL,
  `team` int(11) DEFAULT NULL,
  `ram` int(11) DEFAULT NULL,
  `carg` text DEFAULT NULL,
  `loc` text DEFAULT NULL,
  `observar` longtext DEFAULT NULL,
  `cnpj` bigint(14) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `seg_res`
--

DROP TABLE IF EXISTS `seg_res`;
CREATE TABLE IF NOT EXISTS `seg_res` (
  `cpf` int(11) NOT NULL,
  `cnpj` int(11) NOT NULL,
  `colab_cpf` int(11) NOT NULL,
  `colab_cnpj` int(11) NOT NULL,
  `infor` text DEFAULT NULL,
  `cod_block` text DEFAULT NULL,
  `cod_infor` int(11) DEFAULT NULL,
  PRIMARY KEY (`cpf`,`cnpj`),
  KEY `seg_res_FKIndex1` (`colab_cnpj`,`colab_cpf`),
  KEY `IFK_Rel_02` (`colab_cnpj`,`colab_cpf`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tel_sen`
--

DROP TABLE IF EXISTS `tel_sen`;
CREATE TABLE IF NOT EXISTS `tel_sen` (
  `Nome` text NOT NULL,
  `Senha` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `valide`
--

DROP TABLE IF EXISTS `valide`;
CREATE TABLE IF NOT EXISTS `valide` (
  `cnpj` int(11) NOT NULL,
  `empr` text NOT NULL,
  `tempo` datetime DEFAULT NULL,
  `ativo` bit(1) DEFAULT NULL,
  PRIMARY KEY (`cnpj`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `valores`
--

DROP TABLE IF EXISTS `valores`;
CREATE TABLE IF NOT EXISTS `valores` (
  `ID` int(11) NOT NULL,
  `VALOR` int(11) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `colab`
--
ALTER TABLE `colab`
  ADD CONSTRAINT `colab_ibfk_1` FOREIGN KEY (`valide_cnpj`) REFERENCES `valide` (`cnpj`);

--
-- Limitadores para a tabela `seg_res`
--
ALTER TABLE `seg_res`
  ADD CONSTRAINT `seg_res_ibfk_1` FOREIGN KEY (`colab_cnpj`,`colab_cpf`) REFERENCES `colab` (`cnpj`, `cpf`);
--
-- Banco de dados: `invent_icb`
--
CREATE DATABASE IF NOT EXISTS `invent_icb` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `invent_icb`;

-- --------------------------------------------------------

--
-- Estrutura da tabela `caract`
--

DROP TABLE IF EXISTS `caract`;
CREATE TABLE IF NOT EXISTS `caract` (
  `id_cod` int(11) NOT NULL,
  `id_situa` int(11) NOT NULL,
  `id_tip` int(11) NOT NULL,
  `marc` text NOT NULL,
  `model` text NOT NULL,
  `descri` text NOT NULL,
  `local` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `eletri`
--

DROP TABLE IF EXISTS `eletri`;
CREATE TABLE IF NOT EXISTS `eletri` (
  `id_cod` int(11) NOT NULL,
  `id_tip` int(11) NOT NULL,
  `tip_eletr` int(11) NOT NULL,
  `model` text NOT NULL,
  `marc` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `eletro`
--

DROP TABLE IF EXISTS `eletro`;
CREATE TABLE IF NOT EXISTS `eletro` (
  `id_cod` int(11) NOT NULL,
  `id_tip` int(11) NOT NULL,
  `tip_eletro` int(11) NOT NULL,
  `model` text NOT NULL,
  `marc` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `empre`
--

DROP TABLE IF EXISTS `empre`;
CREATE TABLE IF NOT EXISTS `empre` (
  `cnpj` bigint(15) NOT NULL,
  `estad` bigint(15) NOT NULL,
  `fant` text NOT NULL,
  `end` text NOT NULL,
  `cid` text NOT NULL,
  `bai` text NOT NULL,
  `cep` bigint(8) NOT NULL,
  `uf` text NOT NULL,
  `tel` bigint(15) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `invent`
--

DROP TABLE IF EXISTS `invent`;
CREATE TABLE IF NOT EXISTS `invent` (
  `id_cod` int(11) DEFAULT NULL,
  `id_nf` int(11) NOT NULL,
  `CNPJ` int(14) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `login`
--

DROP TABLE IF EXISTS `login`;
CREATE TABLE IF NOT EXISTS `login` (
  `Codigo` int(4) NOT NULL,
  `Nome` text NOT NULL,
  `Nivel` int(1) NOT NULL,
  `dep` int(2) NOT NULL,
  `Senha` text NOT NULL,
  KEY `Codigo` (`Codigo`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `mov`
--

DROP TABLE IF EXISTS `mov`;
CREATE TABLE IF NOT EXISTS `mov` (
  `id_cod` int(11) NOT NULL,
  `id_tip` int(11) NOT NULL,
  `tip_mov` int(11) NOT NULL,
  `marc` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `nf`
--

DROP TABLE IF EXISTS `nf`;
CREATE TABLE IF NOT EXISTS `nf` (
  `id_nf` int(11) NOT NULL,
  `dt_comp` date NOT NULL,
  `dt_garant` date NOT NULL,
  `descr` text NOT NULL,
  `link` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `outr`
--

DROP TABLE IF EXISTS `outr`;
CREATE TABLE IF NOT EXISTS `outr` (
  `id_cod` int(11) NOT NULL,
  `id_tip` int(11) NOT NULL,
  `tip_out` int(11) NOT NULL,
  `model` text NOT NULL,
  `marc` text NOT NULL,
  `prod` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `situac`
--

DROP TABLE IF EXISTS `situac`;
CREATE TABLE IF NOT EXISTS `situac` (
  `id_situa` int(11) NOT NULL AUTO_INCREMENT,
  `situa` text NOT NULL,
  PRIMARY KEY (`id_situa`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tecno`
--

DROP TABLE IF EXISTS `tecno`;
CREATE TABLE IF NOT EXISTS `tecno` (
  `id_cod` int(11) NOT NULL,
  `id_tip` int(11) NOT NULL,
  `tip_tec` int(11) NOT NULL,
  `model` text NOT NULL,
  `marc` text NOT NULL,
  `proc` text NOT NULL,
  `memo` text NOT NULL,
  `dsk` text NOT NULL,
  `ip` text NOT NULL,
  `nome` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tip`
--

DROP TABLE IF EXISTS `tip`;
CREATE TABLE IF NOT EXISTS `tip` (
  `id_tip` int(11) NOT NULL AUTO_INCREMENT,
  `tip_prod` text NOT NULL,
  PRIMARY KEY (`id_tip`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tip_eletr`
--

DROP TABLE IF EXISTS `tip_eletr`;
CREATE TABLE IF NOT EXISTS `tip_eletr` (
  `tip_eletr` int(11) NOT NULL,
  `descri` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tip_eletro`
--

DROP TABLE IF EXISTS `tip_eletro`;
CREATE TABLE IF NOT EXISTS `tip_eletro` (
  `tip_eletro` int(11) NOT NULL,
  `descri` text NOT NULL,
  PRIMARY KEY (`tip_eletro`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tip_m`
--

DROP TABLE IF EXISTS `tip_m`;
CREATE TABLE IF NOT EXISTS `tip_m` (
  `tip_mov` int(11) NOT NULL,
  `descri` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tip_outr`
--

DROP TABLE IF EXISTS `tip_outr`;
CREATE TABLE IF NOT EXISTS `tip_outr` (
  `tip_out` int(11) NOT NULL,
  `descri` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tip_tecni`
--

DROP TABLE IF EXISTS `tip_tecni`;
CREATE TABLE IF NOT EXISTS `tip_tecni` (
  `tip_tec` int(11) NOT NULL,
  `descri` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `valide`
--

DROP TABLE IF EXISTS `valide`;
CREATE TABLE IF NOT EXISTS `valide` (
  `cnpj` int(11) NOT NULL,
  `empr` text NOT NULL,
  `tempo` datetime DEFAULT NULL,
  `ativo` bit(1) DEFAULT NULL,
  PRIMARY KEY (`cnpj`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
--
-- Banco de dados: `test`
--
CREATE DATABASE IF NOT EXISTS `test` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `test`;
--
-- Banco de dados: `teste`
--
CREATE DATABASE IF NOT EXISTS `teste` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `teste`;
--
-- Banco de dados: `testes`
--
CREATE DATABASE IF NOT EXISTS `testes` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `testes`;

-- --------------------------------------------------------

--
-- Estrutura da tabela `acessos`
--

DROP TABLE IF EXISTS `acessos`;
CREATE TABLE IF NOT EXISTS `acessos` (
  `conv` text NOT NULL,
  `user` text NOT NULL,
  `pass` text NOT NULL,
  `contato` text NOT NULL,
  `guia` text NOT NULL,
  `obser` text NOT NULL,
  `link_email` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `status`
--

DROP TABLE IF EXISTS `status`;
CREATE TABLE IF NOT EXISTS `status` (
  `STATUS` text NOT NULL,
  `PACIENTE` text NOT NULL,
  `CONV` text NOT NULL,
  `MATRICULA` text NOT NULL,
  `PROC` text NOT NULL,
  `MEDICO` text NOT NULL,
  `OLHO` text NOT NULL,
  `DATA` date NOT NULL,
  `GUIA` text NOT NULL,
  `OBS` text NOT NULL,
  `id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
