-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Tempo de geração: 14-Abr-2021 às 17:33
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
-- Banco de dados: `cst`
--

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
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
