--
-- PostgreSQL database dump
--

-- Dumped from database version 13.1
-- Dumped by pg_dump version 13.1

-- Started on 2021-08-15 18:54:21

SET statement_timeout = 0;
SET lock_timeout = 0;
SET idle_in_transaction_session_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SELECT pg_catalog.set_config('search_path', '', false);
SET check_function_bodies = false;
SET xmloption = content;
SET client_min_messages = warning;
SET row_security = off;

--
-- TOC entry 3 (class 2615 OID 2200)
-- Name: public; Type: SCHEMA; Schema: -; Owner: -
--

CREATE SCHEMA public;


--
-- TOC entry 3073 (class 0 OID 0)
-- Dependencies: 3
-- Name: SCHEMA public; Type: COMMENT; Schema: -; Owner: -
--

COMMENT ON SCHEMA public IS 'standard public schema';


--
-- TOC entry 214 (class 1255 OID 33942)
-- Name: is_admin(text, text); Type: FUNCTION; Schema: public; Owner: -
--

CREATE FUNCTION public.is_admin(text, text) RETURNS integer
    LANGUAGE plpgsql
    AS $_$
	declare f_login alias for $1; 
	declare f_password alias for $2;
	declare id integer; 
	declare retour integer; 

begin 
	select into id idutilisateur from bp_admin where login = f_login and password = f_password and grade='admin'; 
	if not found 
	then 
	retour = 0; 
	else 
	retour = 1; 
	end if; 
	return retour; 
	end;
	
$_$;


--
-- TOC entry 213 (class 1255 OID 33939)
-- Name: is_utilisateur(text, text); Type: FUNCTION; Schema: public; Owner: -
--

CREATE FUNCTION public.is_utilisateur(text, text) RETURNS integer
    LANGUAGE plpgsql
    AS $_$

	declare f_login alias for $1; 
	declare f_password alias for $2;
	declare id integer; 
	declare retour integer; 

begin 
	select into id idutilisateur from bp_admin where login = f_login and password = f_password; 
	if not found 
	then 
	retour = 0; 
	else 
	retour = 1; 
	end if; 
	return retour; 
	end;$_$;


SET default_tablespace = '';

SET default_table_access_method = heap;

--
-- TOC entry 200 (class 1259 OID 33484)
-- Name: album; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public.album (
    idalbum integer NOT NULL,
    nomalbum text NOT NULL,
    datealbum integer NOT NULL,
    imagealbum text
);


--
-- TOC entry 211 (class 1259 OID 33949)
-- Name: auto_increment; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE public.auto_increment
    START WITH 4
    INCREMENT BY 1
    MINVALUE 4
    MAXVALUE 99999
    CACHE 1;


--
-- TOC entry 208 (class 1259 OID 33904)
-- Name: bp_admin; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public.bp_admin (
    idutilisateur integer NOT NULL,
    login text NOT NULL,
    password text NOT NULL,
    grade text NOT NULL
);


--
-- TOC entry 212 (class 1259 OID 33951)
-- Name: bp_admin_idutilisateur_seq; Type: SEQUENCE; Schema: public; Owner: -
--

ALTER TABLE public.bp_admin ALTER COLUMN idutilisateur ADD GENERATED ALWAYS AS IDENTITY (
    SEQUENCE NAME public.bp_admin_idutilisateur_seq
    START WITH 3
    INCREMENT BY 1
    NO MINVALUE
    MAXVALUE 999999
    CACHE 1
);


--
-- TOC entry 207 (class 1259 OID 33896)
-- Name: commentaire; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public.commentaire (
    idcommentaire integer NOT NULL,
    textcommentaire text NOT NULL,
    idplaylist integer NOT NULL,
    idutilisateur integer NOT NULL
);


--
-- TOC entry 201 (class 1259 OID 33492)
-- Name: genre; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public.genre (
    idgenre integer NOT NULL,
    nomgenre text NOT NULL,
    descriptiongenre text NOT NULL
);


--
-- TOC entry 203 (class 1259 OID 33508)
-- Name: interprete; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public.interprete (
    idinterprete integer NOT NULL,
    nominterprete text NOT NULL,
    prenominterprete text,
    dateinterprete integer NOT NULL
);


--
-- TOC entry 204 (class 1259 OID 33516)
-- Name: playlist; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public.playlist (
    idplaylist integer NOT NULL,
    nomplaylist text NOT NULL,
    descriptionplaylist text NOT NULL,
    imageplaylist text
);


--
-- TOC entry 202 (class 1259 OID 33500)
-- Name: titre; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public.titre (
    idtitre integer NOT NULL,
    idgenre integer NOT NULL,
    idalbum integer NOT NULL,
    idplaylist integer NOT NULL,
    idinterprete integer NOT NULL,
    nomtitre text NOT NULL,
    datetitre integer NOT NULL,
    mp3titre text
);


--
-- TOC entry 206 (class 1259 OID 33859)
-- Name: rap; Type: VIEW; Schema: public; Owner: -
--

CREATE VIEW public.rap AS
 SELECT titre.idtitre,
    titre.idgenre,
    titre.idalbum,
    titre.idplaylist,
    titre.idinterprete,
    titre.nomtitre,
    titre.datetitre,
    titre.mp3titre
   FROM public.titre
  WHERE (titre.idplaylist = 3);


--
-- TOC entry 209 (class 1259 OID 33912)
-- Name: vote; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public.vote (
    idvote integer NOT NULL,
    votechoix integer NOT NULL,
    idutilisateur integer NOT NULL,
    idtitre integer NOT NULL
);


--
-- TOC entry 210 (class 1259 OID 33943)
-- Name: vue_info_titre; Type: VIEW; Schema: public; Owner: -
--

CREATE VIEW public.vue_info_titre AS
 SELECT t.idtitre,
    t.nomtitre,
    t.datetitre,
    t.mp3titre,
    a.imagealbum,
    g.nomgenre,
    i.nominterprete,
    i.prenominterprete,
    p.idplaylist,
    p.nomplaylist
   FROM ((((public.titre t
     JOIN public.album a ON ((a.idalbum = t.idalbum)))
     JOIN public.genre g ON ((g.idgenre = t.idgenre)))
     JOIN public.interprete i ON ((i.idinterprete = t.idinterprete)))
     JOIN public.playlist p ON ((p.idplaylist = t.idplaylist)));


--
-- TOC entry 205 (class 1259 OID 33855)
-- Name: vue_playlist; Type: VIEW; Schema: public; Owner: -
--

CREATE VIEW public.vue_playlist AS
 SELECT playlist.nomplaylist,
    playlist.descriptionplaylist
   FROM public.playlist;


--
-- TOC entry 3058 (class 0 OID 33484)
-- Dependencies: 200
-- Data for Name: album; Type: TABLE DATA; Schema: public; Owner: -
--

INSERT INTO public.album (idalbum, nomalbum, datealbum, imagealbum) VALUES (2, 'Nirvanna', 2002, '2.jpg');
INSERT INTO public.album (idalbum, nomalbum, datealbum, imagealbum) VALUES (3, 'By The Way
', 2002, '3.jpg');
INSERT INTO public.album (idalbum, nomalbum, datealbum, imagealbum) VALUES (4, 'Songs of Anarchy', 2012, '4.jpg');
INSERT INTO public.album (idalbum, nomalbum, datealbum, imagealbum) VALUES (6, 'Bloodstone & Diamonds', 2014, '6.jpg');
INSERT INTO public.album (idalbum, nomalbum, datealbum, imagealbum) VALUES (7, 'Discorvery', 2020, '7.jpg');
INSERT INTO public.album (idalbum, nomalbum, datealbum, imagealbum) VALUES (8, 'Suffocate/Habitation', 2011, '8.jpg');
INSERT INTO public.album (idalbum, nomalbum, datealbum, imagealbum) VALUES (9, 'Dark Before Dawn', 2015, '9.jpg');
INSERT INTO public.album (idalbum, nomalbum, datealbum, imagealbum) VALUES (10, 'Burn Your Own Church', 2007, '10.jpg');
INSERT INTO public.album (idalbum, nomalbum, datealbum, imagealbum) VALUES (11, 'I Need You', 2018, '11.jpg');
INSERT INTO public.album (idalbum, nomalbum, datealbum, imagealbum) VALUES (12, 'The Warehouse', 2020, '12.jpg');
INSERT INTO public.album (idalbum, nomalbum, datealbum, imagealbum) VALUES (13, 'Curtain Call', 2005, '13.jpg');
INSERT INTO public.album (idalbum, nomalbum, datealbum, imagealbum) VALUES (14, 'Le Son de l''Été', 2020, '14.jpg');
INSERT INTO public.album (idalbum, nomalbum, datealbum, imagealbum) VALUES (15, 'Every Six Seconds', 2001, '15.jpg');
INSERT INTO public.album (idalbum, nomalbum, datealbum, imagealbum) VALUES (16, 'Cradle 2 The Grave', 2003, '16.jpg');
INSERT INTO public.album (idalbum, nomalbum, datealbum, imagealbum) VALUES (17, '2001', 1999, '17.jpg');
INSERT INTO public.album (idalbum, nomalbum, datealbum, imagealbum) VALUES (18, 'Most of the Animals', 1992, '18.jpg');
INSERT INTO public.album (idalbum, nomalbum, datealbum, imagealbum) VALUES (19, 'Follow Me ', 2020, '19.jpg');
INSERT INTO public.album (idalbum, nomalbum, datealbum, imagealbum) VALUES (20, '?', 2018, '20.jpg');
INSERT INTO public.album (idalbum, nomalbum, datealbum, imagealbum) VALUES (21, 'Followers ', 2020, '21.jpg');
INSERT INTO public.album (idalbum, nomalbum, datealbum, imagealbum) VALUES (22, 'The Eminem Show', 2002, '22.jpg');
INSERT INTO public.album (idalbum, nomalbum, datealbum, imagealbum) VALUES (23, 'Aftershock', 2017, '23.jpg');
INSERT INTO public.album (idalbum, nomalbum, datealbum, imagealbum) VALUES (24, 'Restless', 2000, '24.jpg');
INSERT INTO public.album (idalbum, nomalbum, datealbum, imagealbum) VALUES (5, 'Come Back to Me', 2020, '5.jpg');
INSERT INTO public.album (idalbum, nomalbum, datealbum, imagealbum) VALUES (25, 'Test', 2021, '25.pnj');
INSERT INTO public.album (idalbum, nomalbum, datealbum, imagealbum) VALUES (1, 'Konvicted', 2006, '1.jpg');


--
-- TOC entry 3064 (class 0 OID 33904)
-- Dependencies: 208
-- Data for Name: bp_admin; Type: TABLE DATA; Schema: public; Owner: -
--

INSERT INTO public.bp_admin (idutilisateur, login, password, grade) OVERRIDING SYSTEM VALUE VALUES (1, 'admin', 'test', 'admin');
INSERT INTO public.bp_admin (idutilisateur, login, password, grade) OVERRIDING SYSTEM VALUE VALUES (3, 'test', 'test', 'admin');
INSERT INTO public.bp_admin (idutilisateur, login, password, grade) OVERRIDING SYSTEM VALUE VALUES (2, 'timothy', 'condorcet', 'utilisateur');
INSERT INTO public.bp_admin (idutilisateur, login, password, grade) OVERRIDING SYSTEM VALUE VALUES (4, 'Jean', 'ordinateur', 'utilisateur');
INSERT INTO public.bp_admin (idutilisateur, login, password, grade) OVERRIDING SYSTEM VALUE VALUES (5, 'Pauline', 'test1234', 'utilisateur');
INSERT INTO public.bp_admin (idutilisateur, login, password, grade) OVERRIDING SYSTEM VALUE VALUES (6, 'Azerty', 'azertyyuiop', 'utilisateur');
INSERT INTO public.bp_admin (idutilisateur, login, password, grade) OVERRIDING SYSTEM VALUE VALUES (7, 'Azerty', 'azertyyuiop', 'utilisateur');
INSERT INTO public.bp_admin (idutilisateur, login, password, grade) OVERRIDING SYSTEM VALUE VALUES (8, 'Quentin', 'PassWord', 'utilisateur');
INSERT INTO public.bp_admin (idutilisateur, login, password, grade) OVERRIDING SYSTEM VALUE VALUES (9, 'Quentin', 'PassWord', 'utilisateur');
INSERT INTO public.bp_admin (idutilisateur, login, password, grade) OVERRIDING SYSTEM VALUE VALUES (10, 'Quentin', 'PassWord', 'utilisateur');
INSERT INTO public.bp_admin (idutilisateur, login, password, grade) OVERRIDING SYSTEM VALUE VALUES (11, 'Quentin', 'PassWord', 'utilisateur');
INSERT INTO public.bp_admin (idutilisateur, login, password, grade) OVERRIDING SYSTEM VALUE VALUES (12, 'Quentin', 'PassWord', 'utilisateur');
INSERT INTO public.bp_admin (idutilisateur, login, password, grade) OVERRIDING SYSTEM VALUE VALUES (13, 'Quentin', 'PassWord', 'utilisateur');
INSERT INTO public.bp_admin (idutilisateur, login, password, grade) OVERRIDING SYSTEM VALUE VALUES (14, 'Quentin', 'PassWord', 'utilisateur');
INSERT INTO public.bp_admin (idutilisateur, login, password, grade) OVERRIDING SYSTEM VALUE VALUES (15, 'Quentin', 'PassWord', 'utilisateur');


--
-- TOC entry 3063 (class 0 OID 33896)
-- Dependencies: 207
-- Data for Name: commentaire; Type: TABLE DATA; Schema: public; Owner: -
--



--
-- TOC entry 3059 (class 0 OID 33492)
-- Dependencies: 201
-- Data for Name: genre; Type: TABLE DATA; Schema: public; Owner: -
--

INSERT INTO public.genre (idgenre, nomgenre, descriptiongenre) VALUES (1, 'Rock', 'Le rock est caractérisé par une mélodie vocale dominante, souvent accompagnée par une ou plusieurs guitares électriques, une guitare basse et une batterie;');
INSERT INTO public.genre (idgenre, nomgenre, descriptiongenre) VALUES (2, 'DnB', 'La Drum and Bass, comme son nom l''indique, se caractérise par le motif rythmique de la batterie : caisse claire + cross-stick, et basse : kick et TR-808, sur un tempo rapide: 160-180 bpm.');
INSERT INTO public.genre (idgenre, nomgenre, descriptiongenre) VALUES (3, 'Rap', 'Style de musique, fondé sur la récitation chantée de textes souvent révoltés et radicaux, scandés sur un rythme répétitif et sur une trame musicale composite.');


--
-- TOC entry 3061 (class 0 OID 33508)
-- Dependencies: 203
-- Data for Name: interprete; Type: TABLE DATA; Schema: public; Owner: -
--

INSERT INTO public.interprete (idinterprete, nominterprete, prenominterprete, dateinterprete) VALUES (2, 'Nirvana', NULL, 1987);
INSERT INTO public.interprete (idinterprete, nominterprete, prenominterprete, dateinterprete) VALUES (3, 'Red Hot Chilli Peppers', NULL, 1983);
INSERT INTO public.interprete (idinterprete, nominterprete, prenominterprete, dateinterprete) VALUES (4, 'Lions', NULL, 2005);
INSERT INTO public.interprete (idinterprete, nominterprete, prenominterprete, dateinterprete) VALUES (5, 'Maduk
', NULL, 1990);
INSERT INTO public.interprete (idinterprete, nominterprete, prenominterprete, dateinterprete) VALUES (6, 'Machine Head', NULL, 1991);
INSERT INTO public.interprete (idinterprete, nominterprete, prenominterprete, dateinterprete) VALUES (7, 'Freaks & Geeks', NULL, 2010);
INSERT INTO public.interprete (idinterprete, nominterprete, prenominterprete, dateinterprete) VALUES (8, 'The Prototypes', NULL, 2000);
INSERT INTO public.interprete (idinterprete, nominterprete, prenominterprete, dateinterprete) VALUES (9, 'Breaking Benjamin', NULL, 1998);
INSERT INTO public.interprete (idinterprete, nominterprete, prenominterprete, dateinterprete) VALUES (10, 'Black Strobe', NULL, 1997);
INSERT INTO public.interprete (idinterprete, nominterprete, prenominterprete, dateinterprete) VALUES (11, 'Delta Heavy', NULL, 2012);
INSERT INTO public.interprete (idinterprete, nominterprete, prenominterprete, dateinterprete) VALUES (12, 'Muzz', NULL, 2002);
INSERT INTO public.interprete (idinterprete, nominterprete, prenominterprete, dateinterprete) VALUES (13, 'Eminem', NULL, 1972);
INSERT INTO public.interprete (idinterprete, nominterprete, prenominterprete, dateinterprete) VALUES (14, 'Scylla', NULL, 1980);
INSERT INTO public.interprete (idinterprete, nominterprete, prenominterprete, dateinterprete) VALUES (15, 'Saliva', NULL, 1996);
INSERT INTO public.interprete (idinterprete, nominterprete, prenominterprete, dateinterprete) VALUES (16, 'DMX', NULL, 1970);
INSERT INTO public.interprete (idinterprete, nominterprete, prenominterprete, dateinterprete) VALUES (17, 'Dr Dre', NULL, 1965);
INSERT INTO public.interprete (idinterprete, nominterprete, prenominterprete, dateinterprete) VALUES (18, 'The Animals', NULL, 1960);
INSERT INTO public.interprete (idinterprete, nominterprete, prenominterprete, dateinterprete) VALUES (19, 'ShockOne', NULL, 1982);
INSERT INTO public.interprete (idinterprete, nominterprete, prenominterprete, dateinterprete) VALUES (20, 'XXXTentacion', NULL, 1998);
INSERT INTO public.interprete (idinterprete, nominterprete, prenominterprete, dateinterprete) VALUES (21, 'Koven', NULL, 2011);
INSERT INTO public.interprete (idinterprete, nominterprete, prenominterprete, dateinterprete) VALUES (22, 'Gee', 'Macky', 2006);
INSERT INTO public.interprete (idinterprete, nominterprete, prenominterprete, dateinterprete) VALUES (23, 'XZibit', NULL, 1974);
INSERT INTO public.interprete (idinterprete, nominterprete, prenominterprete, dateinterprete) VALUES (25, 'NF', '', 1991);
INSERT INTO public.interprete (idinterprete, nominterprete, prenominterprete, dateinterprete) VALUES (1, 'Akon', '', 1976);


--
-- TOC entry 3062 (class 0 OID 33516)
-- Dependencies: 204
-- Data for Name: playlist; Type: TABLE DATA; Schema: public; Owner: -
--

INSERT INTO public.playlist (idplaylist, nomplaylist, descriptionplaylist, imageplaylist) VALUES (2, 'I love DnB', 'Playlist contenant tous les meilleurs sons Drumb and Bass', 'dnb.jpg');
INSERT INTO public.playlist (idplaylist, nomplaylist, descriptionplaylist, imageplaylist) VALUES (3, 'I love Rap ', 'Playlist contenant tous les meilleurs sons Rap ', 'rap.jpg');
INSERT INTO public.playlist (idplaylist, nomplaylist, descriptionplaylist, imageplaylist) VALUES (1, 'I love Rock!', 'Playlist contenant tous les meilleurs sons Rock', 'rock.jpg');


--
-- TOC entry 3060 (class 0 OID 33500)
-- Dependencies: 202
-- Data for Name: titre; Type: TABLE DATA; Schema: public; Owner: -
--

INSERT INTO public.titre (idtitre, idgenre, idalbum, idplaylist, idinterprete, nomtitre, datetitre, mp3titre) VALUES (2, 1, 2, 1, 2, 'Smells Like Teen Spirit', 2002, '2.mp3');
INSERT INTO public.titre (idtitre, idgenre, idalbum, idplaylist, idinterprete, nomtitre, datetitre, mp3titre) VALUES (3, 1, 3, 1, 3, 'By The Way', 2002, '3.mp3');
INSERT INTO public.titre (idtitre, idgenre, idalbum, idplaylist, idinterprete, nomtitre, datetitre, mp3titre) VALUES (4, 1, 4, 1, 4, 'Girl From The North Country', 2012, '4.mp3');
INSERT INTO public.titre (idtitre, idgenre, idalbum, idplaylist, idinterprete, nomtitre, datetitre, mp3titre) VALUES (5, 2, 5, 2, 5, 'Come Back To Me', 2020, '5.mp3');
INSERT INTO public.titre (idtitre, idgenre, idalbum, idplaylist, idinterprete, nomtitre, datetitre, mp3titre) VALUES (6, 1, 6, 1, 6, 'Game Over', 2014, '6.mp3');
INSERT INTO public.titre (idtitre, idgenre, idalbum, idplaylist, idinterprete, nomtitre, datetitre, mp3titre) VALUES (7, 2, 7, 2, 7, 'Discorvery', 2020, '7.mp3');
INSERT INTO public.titre (idtitre, idgenre, idalbum, idplaylist, idinterprete, nomtitre, datetitre, mp3titre) VALUES (8, 2, 8, 2, 8, 'Suffocate', 2011, '8.mp3');
INSERT INTO public.titre (idtitre, idgenre, idalbum, idplaylist, idinterprete, nomtitre, datetitre, mp3titre) VALUES (9, 1, 9, 1, 9, 'Angels Fall', 2015, '9.mp3');
INSERT INTO public.titre (idtitre, idgenre, idalbum, idplaylist, idinterprete, nomtitre, datetitre, mp3titre) VALUES (10, 1, 10, 1, 10, 'I''m a Man', 2007, '10.mp3');
INSERT INTO public.titre (idtitre, idgenre, idalbum, idplaylist, idinterprete, nomtitre, datetitre, mp3titre) VALUES (11, 2, 11, 2, 11, 'I Need You', 2018, '11.mp3');
INSERT INTO public.titre (idtitre, idgenre, idalbum, idplaylist, idinterprete, nomtitre, datetitre, mp3titre) VALUES (12, 2, 12, 2, 12, 'The Warehouse', 2020, '12.mp3');
INSERT INTO public.titre (idtitre, idgenre, idalbum, idplaylist, idinterprete, nomtitre, datetitre, mp3titre) VALUES (13, 3, 13, 3, 13, 'Lose Yourself', 2005, '13.mp3');
INSERT INTO public.titre (idtitre, idgenre, idalbum, idplaylist, idinterprete, nomtitre, datetitre, mp3titre) VALUES (14, 3, 14, 3, 14, 'Le Son de l''Été', 2020, '14.mp3');
INSERT INTO public.titre (idtitre, idgenre, idalbum, idplaylist, idinterprete, nomtitre, datetitre, mp3titre) VALUES (15, 1, 15, 1, 15, 'Click Click Boom', 2001, '15.mp3');
INSERT INTO public.titre (idtitre, idgenre, idalbum, idplaylist, idinterprete, nomtitre, datetitre, mp3titre) VALUES (16, 3, 16, 3, 16, 'X Gon''Give It To Ya', 2003, '16.mp3');
INSERT INTO public.titre (idtitre, idgenre, idalbum, idplaylist, idinterprete, nomtitre, datetitre, mp3titre) VALUES (17, 3, 17, 3, 17, 'Still D.R.E.', 1999, '17.mp3');
INSERT INTO public.titre (idtitre, idgenre, idalbum, idplaylist, idinterprete, nomtitre, datetitre, mp3titre) VALUES (18, 1, 18, 1, 18, 'House Of The Rising Sun', 1992, '18.mp3');
INSERT INTO public.titre (idtitre, idgenre, idalbum, idplaylist, idinterprete, nomtitre, datetitre, mp3titre) VALUES (19, 2, 19, 2, 19, 'Follow Me ', 2020, '19.mp3');
INSERT INTO public.titre (idtitre, idgenre, idalbum, idplaylist, idinterprete, nomtitre, datetitre, mp3titre) VALUES (20, 3, 20, 3, 20, 'Moonlight', 2018, '20.mp3');
INSERT INTO public.titre (idtitre, idgenre, idalbum, idplaylist, idinterprete, nomtitre, datetitre, mp3titre) VALUES (21, 2, 21, 2, 21, 'Followers (A.M.C. Remix)', 2020, '21.mp3');
INSERT INTO public.titre (idtitre, idgenre, idalbum, idplaylist, idinterprete, nomtitre, datetitre, mp3titre) VALUES (22, 3, 22, 3, 13, 'Without Me', 2002, '22.mp3');
INSERT INTO public.titre (idtitre, idgenre, idalbum, idplaylist, idinterprete, nomtitre, datetitre, mp3titre) VALUES (23, 2, 23, 2, 22, 'Make Me Feel', 2017, '23.mp3');
INSERT INTO public.titre (idtitre, idgenre, idalbum, idplaylist, idinterprete, nomtitre, datetitre, mp3titre) VALUES (24, 3, 24, 3, 23, 'X', 2000, '24.mp3');
INSERT INTO public.titre (idtitre, idgenre, idalbum, idplaylist, idinterprete, nomtitre, datetitre, mp3titre) VALUES (1, 3, 1, 3, 1, 'Smack That', 2006, '1.mp3');
INSERT INTO public.titre (idtitre, idgenre, idalbum, idplaylist, idinterprete, nomtitre, datetitre, mp3titre) VALUES (45, 1, 20, 1, 20, 'test', 2022, '1.mp3');


--
-- TOC entry 3065 (class 0 OID 33912)
-- Dependencies: 209
-- Data for Name: vote; Type: TABLE DATA; Schema: public; Owner: -
--



--
-- TOC entry 3074 (class 0 OID 0)
-- Dependencies: 211
-- Name: auto_increment; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('public.auto_increment', 4, false);


--
-- TOC entry 3075 (class 0 OID 0)
-- Dependencies: 212
-- Name: bp_admin_idutilisateur_seq; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('public.bp_admin_idutilisateur_seq', 15, true);


--
-- TOC entry 2902 (class 2606 OID 33491)
-- Name: album album_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.album
    ADD CONSTRAINT album_pkey PRIMARY KEY (idalbum);


--
-- TOC entry 2912 (class 2606 OID 33903)
-- Name: commentaire commentaire_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.commentaire
    ADD CONSTRAINT commentaire_pkey PRIMARY KEY (idcommentaire);


--
-- TOC entry 2904 (class 2606 OID 33499)
-- Name: genre genre_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.genre
    ADD CONSTRAINT genre_pkey PRIMARY KEY (idgenre);


--
-- TOC entry 2908 (class 2606 OID 33515)
-- Name: interprete interprete_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.interprete
    ADD CONSTRAINT interprete_pkey PRIMARY KEY (idinterprete);


--
-- TOC entry 2910 (class 2606 OID 33523)
-- Name: playlist playlist_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.playlist
    ADD CONSTRAINT playlist_pkey PRIMARY KEY (idplaylist);


--
-- TOC entry 2906 (class 2606 OID 33507)
-- Name: titre titre_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.titre
    ADD CONSTRAINT titre_pkey PRIMARY KEY (idtitre);


--
-- TOC entry 2914 (class 2606 OID 33911)
-- Name: bp_admin utilisateur_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.bp_admin
    ADD CONSTRAINT utilisateur_pkey PRIMARY KEY (idutilisateur);


--
-- TOC entry 2916 (class 2606 OID 33916)
-- Name: vote vote_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.vote
    ADD CONSTRAINT vote_pkey PRIMARY KEY (idvote);


--
-- TOC entry 2921 (class 2606 OID 33917)
-- Name: commentaire commentaire_idplaylist_fkey; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.commentaire
    ADD CONSTRAINT commentaire_idplaylist_fkey FOREIGN KEY (idplaylist) REFERENCES public.playlist(idplaylist);


--
-- TOC entry 2922 (class 2606 OID 33922)
-- Name: commentaire commentaire_idutilisateur_fkey; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.commentaire
    ADD CONSTRAINT commentaire_idutilisateur_fkey FOREIGN KEY (idutilisateur) REFERENCES public.bp_admin(idutilisateur);


--
-- TOC entry 2918 (class 2606 OID 33529)
-- Name: titre titre_idalbum_fkey; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.titre
    ADD CONSTRAINT titre_idalbum_fkey FOREIGN KEY (idalbum) REFERENCES public.album(idalbum);


--
-- TOC entry 2917 (class 2606 OID 33524)
-- Name: titre titre_idgenre_fkey; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.titre
    ADD CONSTRAINT titre_idgenre_fkey FOREIGN KEY (idgenre) REFERENCES public.genre(idgenre);


--
-- TOC entry 2920 (class 2606 OID 33539)
-- Name: titre titre_idinterprete_fkey; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.titre
    ADD CONSTRAINT titre_idinterprete_fkey FOREIGN KEY (idinterprete) REFERENCES public.interprete(idinterprete);


--
-- TOC entry 2919 (class 2606 OID 33534)
-- Name: titre titre_idplaylist_fkey; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.titre
    ADD CONSTRAINT titre_idplaylist_fkey FOREIGN KEY (idplaylist) REFERENCES public.playlist(idplaylist);


--
-- TOC entry 2924 (class 2606 OID 33932)
-- Name: vote vote_idtitre_fkey; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.vote
    ADD CONSTRAINT vote_idtitre_fkey FOREIGN KEY (idtitre) REFERENCES public.titre(idtitre);


--
-- TOC entry 2923 (class 2606 OID 33927)
-- Name: vote vote_idutilisateur_fkey; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.vote
    ADD CONSTRAINT vote_idutilisateur_fkey FOREIGN KEY (idutilisateur) REFERENCES public.bp_admin(idutilisateur);


-- Completed on 2021-08-15 18:54:21

--
-- PostgreSQL database dump complete
--

