CREATE DATABASE IF NOT EXISTS concerts
DEFAULT CHARACTER SET utf8mb4
COLLATE utf8mb4_general_ci;
USE concerts;

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `concerts`
--

-- --------------------------------------------------------

--
-- Structure de la table `artiste`
--

DROP TABLE IF EXISTS `artiste`;
CREATE TABLE IF NOT EXISTS `artiste` (
  `idArtiste` int NOT NULL AUTO_INCREMENT,
  `nom` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `genre` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `photo` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `badge` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`idArtiste`)
) ENGINE=InnoDB AUTO_INCREMENT=97 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `artiste`
--

INSERT INTO `artiste` (`idArtiste`, `nom`, `genre`, `photo`, `badge`) VALUES
(1, 'David Guetta', '', 'https://images.sk-static.com/images/media/profile_images/artists/149066/huge_avatar', 0),
(2, 'Taylor Swift', '', 'https://resize-elle.ladmedia.fr/r/625,,forcex/crop/625,804,center-middle,forcex,ffffff/img/var/plain_site/storage/images/personnalites/taylor-swift/42391722-2-fre-FR/Taylor-Swift.jpg', 0),
(3, 'Symphony of Unity', '', 'https://prismic-assets-cdn.tomorrowland.com/Zg5YdTskWekewC1z_1690648109136_78786f9b-70c5-46dd-9f5b-a9d94c42a40f.jpg_5504_16994556994422367398.jpg', 0),
(4, 'Marlon Hoffstadt', '', 'https://i.discogs.com/8LMi4gSq_TX6Po3HFN3Hq1o6ZFNtshe-x9uimUEh0ys/rs:fit/g:sm/q:90/h:600/w:600/czM6Ly9kaXNjb2dz/LWRhdGFiYXNlLWlt/YWdlcy9BLTI2MjMw/NjEtMTU5OTAzNjQ3/NS05NjI2LmpwZWc.jpeg', 0),
(5, 'Martin Garrix', '', 'https://d21buns5ku92am.cloudfront.net/68681/images/388052-JBL%2Bx_shootHighRes_v3-58e07d-large-1618928217.png', 0),
(6, 'Kevin de Vries', '', 'https://www.guettapen.com/wp-content/uploads/2022/08/Kevin-De-Vries-web.jpg', 0),
(7, 'Tiësto', '', 'https://media.lasvegasmagazine.com/media/img/photos/2022/05/06/Tiesto_CDV_LD2_t1024.jpg?b3f067808e872500b33dd7ef4ee517933144b05a', 0),
(8, 'Timmy Trumpet', '', 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTCEll0L6mVJsZwkVVdxaFM56yiq10GT_bWfg&s', 0),
(9, 'Tita Lau', '', 'https://d3vhc53cl8e8km.cloudfront.net/hello-staging/wp-content/uploads/2023/04/13230929/5laM2bqLzm5jcPqmvt3xcGQUpaGUZXwMoYJ8lXEb-972x597.jpeg', 0),
(10, 'Wade', '', 'https://geo-media.beatport.com/image_size/590x404/62774c85-8d5b-46d1-b243-329abde322ea.jpg', 0),
(11, 'Kygo', '', 'https://dynamicmedia.livenationinternational.com/a/w/i/3a3cb268-09d3-42e7-bf75-bee58df05193.jpg', 0),
(12, 'Sofi Tukker', '', 'https://blogger.googleusercontent.com/img/b/R29vZ2xl/AVvXsEgQlqtl-NVjroJuN05mU-agFpSGLDSo7gnQHee1Lo8VaYJz49mfFqjFDzudZpfkiN_Xa6gRQNXe6-V-b4OskLff8ZmVaQxMfLUMSqbKEyQIZvdco-tZMaS_FH6l4AlbxPpVS7N1cRLz5OM/s1600/SOFI.jpg', 0),
(13, 'DJ Snake', '', 'https://i.scdn.co/image/ab6761610000e5ebca97cf089968b569e29d795c', 0),
(14, 'Trinix', '', 'https://www.artistikrezo.com/wp-content/uploads/2022/12/Trinixmusic-830x1024.jpg', 0),
(15, 'Saverio', '', '', 0),
(16, 'Mosimann', '', 'https://www.warehouse-nantes.fr/media/cache/square_1000/images/artist_image/5e564daff1c2c725204622.webp', 0),
(17, 'Petit Biscuit', '', 'https://www.rodmusic.fr/wp-content/uploads/2023/07/PetitBiscuit_YouDontIgnore.jpg', 0),
(18, 'Ofenbach', '', 'https://res.cloudinary.com/shotgun/image/upload/v1705684067/production/artworks/artists/weareofenbach.jpg', 0),
(19, 'Meduza', '', 'https://photos.bandsintown.com/thumb/11253357.jpeg', 0),
(20, 'Kungs', '', 'https://image.ausha.co/b7W1RD6nraiWmu2f9F0OhL1ytLsF8H42ZU9qbyFD_1400x1400.jpeg?t=1687238667', 0),
(21, 'Tchami & Malaa', '', 'https://www.dancemusicnw.com/wp-content/uploads/2018/04/no-redemption.jpg', 0),
(22, 'Martin Solveig', '', 'https://yt3.googleusercontent.com/ytc/AIdro_nr2qRuQOWWSIZTtRDsRZiK3SaqEN6QHIw8HDHo7wXk-ms=s900-c-k-c0x00ffffff-no-rj', 0),
(23, 'Diplo', '', 'https://www.solidays.org/wp-content/uploads/2023/11/diplo_minia-1140x570.jpg', 0),
(24, 'R3HAB', '', 'https://www.wknd.fi/content/uploads/2023/06/gradient-2-scaled-e1688043073830.jpg', 0),
(25, 'W&W', '', 'https://yt3.googleusercontent.com/wxQZ7XgTXGL767Z-t-Ln_xmEIGvnVmzJMA4PRQtR3EvNV-ppALswEDmvqGsUW3AEQKsgN5kKyz0=s900-c-k-c0x00ffffff-no-rj', 0),
(26, 'Tate McRae', '', 'https://ca.billboard.com/media-library/tate-mcrae-at-the-2023-billboard-music-awards-at-the-moxy-hotel-in-los-angeles-california-the-show-airs-on-november-19-2023-o.jpg?id=50515696&width=1200&height=800&quality=90&coordinates=0%2C0%2C0%2C0', 0),
(27, 'Charlieonnafriday', '', 'https://dynamicmedia.livenationinternational.com/a/d/g/52886b00-626f-4999-9569-dd778d754239.jpg', 0),
(28, 'Paramore', '', 'https://www.rocktotal.com/wp-content/uploads/2021/11/paramore.jpg', 0),
(29, 'Mike Dean', '', 'https://www.rollingstone.com/wp-content/uploads/2020/04/mike-dean.jpg', 0),
(30, 'Alan Walker', '', 'https://tinderbox.dk/wp-content/uploads/sites/2/2024/02/Alan-Walker.jpg', 0),
(31, 'Au/Ra', '', 'https://d2ljoqkkoec4f6.cloudfront.net/wp-content/uploads/2022/01/17164619/a1.jpg', 0),
(32, 'Goodboys', '', 'https://headlinermagazine.net/assets/img/assets/img/2022/Goodboys_interview_1_1.jpg', 0),
(33, 'DJ Bens', '', 'https://www.warehouse-nantes.fr/media/cache/square_1000/images/artist_image/6149d3658051d571423124.webp', 0),
(34, 'Vladimir Cauchemar', '', 'https://media.sudouest.fr/11731207/1200x600/vlad2.jpg', 0),
(35, 'Le Pedre', '', 'https://img.nrj.fr/BlBbv7bUJLmNBTVY9IFh4JTH7FM=/800x450/smart/medias%2F2021%2F04%2Ffloydrenton-9_607d60988c073.jpg', 0),
(36, 'Raw', '', '', 0),
(37, 'Shad', '', 'https://maville.com/photosmvi/2023/08/28/P33152581D5912152G.jpg', 0),
(38, 'Snight B', '', 'https://static.actu.fr/uploads/2020/09/dj-snight-b-960x640.jpg', 0),
(39, 'Angèle Brol', '', 'https://images.rtl.fr/~c/1200v800/rtl/www/1218186-festival-de-cannes-2019-la-chanteuse-belge-angele-sur-le-tapis-rouge.jpg', 0),
(40, 'Adèle Castillon', '', 'https://www.aficia.info/wp-content/uploads/2023/06/banniere-aficia-23.png', 0),
(41, 'Ava Max', '', 'https://img.nrj.fr/YxkaFD8L6YgWU7LRlZhO7IlGf2g=/medias%2F2022%2F10%2F634016a586507_634016ad7916f.jpg', 0),
(42, 'Joel Corry', '', 'https://ibiza-spotlight1.b-cdn.net/sites/default/files/styles/auto_1500_width/public/article-images/139645/slideshow-1690975568.jpg', 0),
(43, 'KSHMR', '', 'https://geo-media.beatport.com/image_size/590x404/a96299a8-5406-4d04-a66c-6f5cb2c8a229.jpg', 0),
(44, 'Alok', '', 'https://www.exitfest.org/wp-content/uploads/2024/04/alok.jpg', 0),
(45, 'Steve Aoki', '', 'https://d3vhc53cl8e8km.cloudfront.net/hello-staging/wp-content/uploads/2014/05/21213257/cb672a62-3015-11ef-954e-0ecc81f4ee58-972x597.jpg', 0),
(46, 'Bekar', '', 'https://i.scdn.co/image/ab6761610000e5eb4e1b2b2e2efe9fe375730ac8', 0),
(47, 'Maroon 5', '', 'https://img.nrj.fr/5K1XR16ymb3Vg5qrR4x7WbtXL0o=/medias%2F2020%2F10%2Fm5-bs-press-1a_5f92e8168c535.jpg', 0),
(48, 'Damso', '', 'https://i.f1g.fr/media/cms/orig/2024/02/15/46cf8efef4ee45f70c381bd1f1e31d7d5a6d7dd65a2283c049f17592a32c95d7.jpg', 0),
(49, 'Niall Horan', '', 'https://www.rollingstone.com/wp-content/uploads/2023/06/Niall-Horan-Album.jpg?w=1581&h=1054&crop=1', 0),
(50, 'The driver Era', '', 'https://i.discogs.com/SrI9EPzNue_31ZtAj_fLf1ypGex8l8UpqZ4s9z6kleQ/rs:fit/g:sm/q:90/h:400/w:600/czM6Ly9kaXNjb2dz/LWRhdGFiYXNlLWlt/YWdlcy9BLTEwMTYx/MzE2LTE2NjMzNDUz/MzQtOTY4Ny5qcGVn.jpeg', 0),
(51, 'Lil Nas X', '', 'https://www.booska-p.com/wp-content/uploads/2023/12/Lil-Nas-X-Visu-News-1024x750.jpg', 0),
(52, 'Rosalia', '', 'https://imageio.forbes.com/specials-images/imageserve/639ba21c2c89cf5733659135/Rosalia-Concert-In-Madrid/960x0.jpg?format=jpg&width=960', 0),
(53, 'The Weeknd', '', 'https://www.radiofrance.fr/s3/cruiser-production/2021/05/e1e9f515-d792-41cd-8872-189e62905985/870x489_gettyimages-1231050791_1.jpg', 0),
(54, 'Kaytranada', '', 'https://www.billboard.com/wp-content/uploads/2023/06/cover-kaytranada-billboard-2023-bb8-joelle-grace-taylor-3-1240.jpg?w=683', 0),
(55, 'M.Pokora', '', 'https://www.parismatch.com/lmnr/var/pm/public/media/image/M.-Pokora.jpg?VersionId=BJvcfj5O639ixWHhpV7OL11_Ola7Vj7m', 0),
(56, 'Tal', '', 'https://img.nrj.fr/ezgxAJ31jpch-69XcDel3n1Saes=/https%3A%2F%2Fmedia.nrj.fr%2F1900x1200%2F2016%2F09%2Ftal-jpg-3979385.jpg', 0),
(57, 'Magic System', '', 'https://i.scdn.co/image/504e83f4449769bb0ba38b8b149e6659f97bb743', 0),
(58, 'Max & Mango', '', 'https://yt3.googleusercontent.com/ytc/AIdro_lPaFsk1qeWWhi0U87s0JKZYhvesJ7inMzxewEA=s900-c-k-c0x00ffffff-no-rj', 0),
(59, 'Syndy', '', 'https://img.ohmymag.com/s3/fromm/1280/people/default_2020-03-02_d1b670e9-889d-41d7-9328-a55e60d46aa8.jpeg', 0),
(60, 'Black M', '', 'https://www.booska-p.com/wp-content/uploads/2023/11/Black-M-Racisme-Visu-News.jpg', 0),
(61, 'Aya Nakamura', '', 'https://www.parismatch.com/lmnr/var/pm/public/media/image/2024/04/10/20/pm-aya-nakamura-2.jpg?VersionId=6oMbQ62kc019Zq.FRsXSEhVJSB3DE51W', 0),
(62, 'Dua Lipa', '', 'https://resize.elle.fr/original/var/plain_site/storage/images/loisirs/musique/news/dua-lipa-choses-que-vous-ne-saviez-pas-sur-la-chanteuse-4100691/98327226-1-fre-FR/Dua-Lipa-5-choses-que-vous-ne-saviez-pas-sur-la-chanteuse.jpg', 0),
(63, 'Sexion d assaut', '', 'https://sf1.closermag.fr/wp-content/uploads/closermag/2023/05/la-sexion-assaut-reforme-pour-une-grande-tournee-2022.jpeg', 0),
(64, 'Robin Schulz', '', 'https://www.pop-himmel.de/wp-content/uploads/2023/07/Robin-Schulz-Main-Press-Image-2023-1-Credit-Philipp-Gladsome-800x600.jpg', 0),
(65, 'Zazie', '', 'https://www.parismatch.com/lmnr/var/pm/public/media/image/2023/08/22/11/sipa_01119040_000008.jpg?VersionId=kVAoFT_iYx8lWgLV93EmhXT71TFW48fm', 0),
(66, 'Skip the Use', '', 'https://lvdneng.rosselcdn.net/sites/default/files/dpistyles_v2/ena_16_9_extra_big/2019/11/20/node_668542/43450469/public/2019/11/20/B9721658051Z.1_20191120215559_000%2BG9TEV17HJ.4-0.jpg?itok=F7p0ovkZ1574283411', 0),
(67, '-M-', '', 'https://img-3.journaldesfemmes.fr/Pdh6-sdbTRVjDttFKMGiziSOshw=/1500x/smart/247afdf8ba3447f0b4be00f03b49a0bc/ccmcms-jdf/39933484.jpg', 0),
(68, 'Roszalie', '', 'https://antipode-rennes.fr/sites/default/files/antipode/styles/facebook_partage/public/ged/atoem_-_titouan_masse-06295.jpeg?itok=x6ARQ97e', 0),
(69, 'Toukan Toukän', '', 'https://i0.wp.com/lesoreillescurieuses.com/wp-content/uploads/2022/11/4156675E-C47C-4183-BAF8-50CCA4550D63.jpeg?fit=2560%2C2560&ssl=1', 0),
(70, 'Morten', '', 'https://images.sk-static.com/images/media/profile_images/artists/8574784/huge_avatar', 0),
(71, 'Gryffin', '', 'https://resources.tidal.com/images/c0326d6a/6e3c/48a5/acec/a5f21359e83b/750x750.jpg', 0),
(72, 'Dimitri Vegas', '', 'https://d3vhc53cl8e8km.cloudfront.net/hello-staging/wp-content/uploads/2024/06/21184250/feb34ef4-2ffd-11ef-b991-0ee6b8365494-1-972x597.jpg', 0),
(73, 'Anyma', '', 'https://www.popnmusic.fr/wp-content/uploads/2024/03/Anyma-revele-la-date-de-sortie-et-la-tracklist-de.png', 0),
(74, 'Dimitri Vegas & Like Mike', '', 'https://cdn-s-www.ledauphine.com/images/7DD71840-B4A9-4E60-9B4E-94445E269729/NW_raw/les-deux-freres-dimitri-vegas-et-like-mike-n-1-mondial-du-dernier-classement-dj-mag-seront-a-pharaonic-le-21-mars-a-chambery-photo-dr-1575967020.jpg', 0),
(75, 'Monocule', '', 'https://weraveyou.com/wp-content/uploads/2020/01/Nicky-Romero-Press-by-Kevin-Anthony-Canales.jpg', 0),
(76, 'Kölsch', '', 'https://media.watchthedj.com/djs/kolsch.jpg', 0),
(77, 'Push', '', 'https://img.gva.be/w0xAXmDci7itKYACr-vPuzwnx4A=/960x640/smart/https%3A%2F%2Fstatic.gva.be%2FAssets%2FImages_Upload%2F2019%2F02%2F21%2F4046402c-2dea-11e9-9651-f26683fc8ddf_web_scale_0.1612115_0.1612115__.jpg', 0),
(78, 'John Newman', '', 'https://i.scdn.co/image/ab6761610000e5eb4eaf903c2b9df9217dafeba8', 0),
(79, 'Hardwell', '', 'https://static-cdn.toi-media.com/fr/uploads/2022/04/%D7%93%D7%99-%D7%92%D7%99-%D7%94%D7%90%D7%A8%D7%93%D7%95%D7%95%D7%9C-%D7%A6%D7%99%D7%9C%D7%95%D7%9D-%D7%99%D7%97%D7%A6-%D7%94%D7%90%D7%A8%D7%93%D7%95%D7%95%D7%9C.jpeg', 0),
(80, 'Barbara Butch', '', 'https://www.contemporainedenimes.com/cdn23_files/uploads/2024/02/Barbara-Butch.jpeg', 0),
(81, 'Feder', '', 'https://img.nrj.fr/cv60KxxuiS5fKIpX5ATS7fTQEgg=/medias%2F2022%2F10%2F633fe080bf18d_633fe08336040.jpg', 0),
(82, 'Klangkarussell', '', 'https://lh3.googleusercontent.com/proxy/AiHpEF3RQl4fDGjSWPLMehtLCyvVLdbpfXTzKTwjR0RZ0yzu5kF5pGCk5IbcXSJ8cl1DHkTQpKtPlS5MGyZMri8sChrOfvAo5--9i7M3SFt9GUGIirRopXylOYn8NwMtzLMdAe4Jku8C0wKOVYOzRfke7RokXcWWNmyYx4gs9dPkPO8MxDAtwzBl4IW7fBs6aZ76V8tAmIFa1adlJn08LQ41bdaTIKuhRJMq4IU', 0),
(83, 'James Hype', '', 'https://static.billets.ca/artist/j8k/h2/james-hype-1200x750.jpg', 0),
(84, 'Imagine Dragons', '', 'https://lh3.googleusercontent.com/TAadzeojHFGU1EJ5jnOWDn6K8Cf8O2x0F04PVxnZwUEhcaYN0pA0dic49VU7OKGs7oovBTylWx70xhY=w2880-h1200-p-l90-rj', 0),
(85, 'Declan McKenna', '', 'https://cdn.prod.website-files.com/607e857d7feb56d9de8c60ab/657763ffcd9067257d7f9b79_Declan-McKenna-4.webp', 0),
(86, 'Katy Perry', '', 'https://www.starmag.com/wp-content/uploads/2024/08/katy-perry-american-idol.webp', 0),
(87, 'Agents of time', 'G', 'https://images.squarespace-cdn.com/content/v1/573c5c8f45bf21715994b612/1710700010061-N08WIC1E5RAIB9TIKWAS/00.jpg?format=1500w', 0),
(88, 'Armin van Buuren', 'M', 'https://i.scdn.co/image/ca02718b0e5c389073e8dba56417acd36f541523', 0),
(89, 'John Summit', 'M', 'https://people.com/thmb/iPyaqXaBikLwqPEATlPN-ik7dOU=/1500x0/filters:no_upscale():max_bytes(150000):strip_icc():focal(731x267:733x269)/john-summit-071224-3-642881bfffc24f19897799c23cfd71af.jpg', 0),
(90, 'Swedish House Mafia', 'M', 'https://static.ra.co/images/profiles/square/swedishhousemafia.jpg?dateUpdated=1680120180273', 0),
(91, 'Griff', 'F', 'https://image.20min.ch/2024/11/19/2c1f1481-4b1e-4e22-a077-cb053f686a5e.jpeg?s=ff30a39a6773decfdbe90535860e40ff', 0),
(92, 'Hayla', 'F', 'https://i.scdn.co/image/ab6761610000e5eb327e391ef0e0e7b11e2db1c9', 0),
(93, 'Parson James', 'H', 'https://resources.tidal.com/images/ca1b87d7/1f57/428e/a059/c806b76b5e71/750x750.jpg', 0),
(94, 'Sandro Cavazza', 'H', 'https://www.c-heads.com/wp-content/uploads/2017/04/01-SandroCavazza_EP.jpg', 0),
(95, 'Showtek', 'D', 'https://cdn-images.dzcdn.net/images/artist/e17eed9ba4884f57e1f4bc5dc6960584/1900x1900-000000-80-0-0.jpg', 0),
(96, 'Zak Abel', 'H', 'https://media.glamourmagazine.co.uk/photos/6138c67b2bec5fcec32c3576/master/w_1600%2Cc_limit/Zak_Abel_984_v1_HI_RES.jpg', 0);

-- --------------------------------------------------------

--
-- Structure de la table `association`
--

DROP TABLE IF EXISTS `association`;
CREATE TABLE IF NOT EXISTS `association` (
  `idAsso` int NOT NULL AUTO_INCREMENT,
  `evenement` int NOT NULL,
  `artiste` int NOT NULL,
  `pPartie` varchar(1) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`idAsso`),
  KEY `Association_evenement_fkey` (`evenement`),
  KEY `Association_artiste_fkey` (`artiste`)
) ENGINE=InnoDB AUTO_INCREMENT=149 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `association`
--

INSERT INTO `association` (`idAsso`, `evenement`, `artiste`, `pPartie`) VALUES
(1, 1, 13, 'N'),
(2, 2, 1, 'N'),
(3, 29, 60, 'N'),
(4, 3, 4, 'N'),
(5, 3, 5, 'N'),
(13, 3, 7, 'N'),
(15, 3, 9, 'N'),
(16, 3, 10, 'N'),
(17, 4, 5, 'N'),
(18, 4, 14, 'N'),
(19, 4, 15, 'N'),
(20, 4, 16, 'N'),
(21, 4, 17, 'N'),
(22, 4, 18, 'N'),
(23, 5, 11, 'N'),
(24, 5, 12, 'O'),
(25, 8, 1, 'N'),
(26, 8, 20, 'N'),
(27, 9, 2, 'N'),
(28, 8, 69, 'O'),
(29, 8, 68, 'O'),
(30, 9, 28, 'O'),
(31, 10, 26, 'N'),
(32, 10, 27, 'O'),
(33, 11, 19, 'N'),
(34, 11, 20, 'N'),
(35, 11, 21, 'N'),
(36, 11, 22, 'N'),
(37, 11, 23, 'N'),
(38, 11, 24, 'N'),
(39, 11, 25, 'N'),
(40, 12, 42, 'N'),
(41, 12, 43, 'N'),
(42, 12, 44, 'N'),
(43, 12, 45, 'N'),
(44, 12, 30, 'N'),
(45, 12, 34, 'N'),
(46, 13, 18, 'N'),
(47, 14, 53, 'N'),
(48, 14, 54, 'O'),
(49, 14, 29, 'O'),
(50, 15, 47, 'N'),
(51, 15, 20, 'N'),
(52, 15, 48, 'N'),
(53, 16, 49, 'N'),
(54, 16, 50, 'N'),
(55, 16, 51, 'N'),
(56, 16, 11, 'N'),
(57, 16, 52, 'N'),
(58, 17, 41, 'N'),
(59, 18, 39, 'N'),
(60, 18, 40, 'O'),
(61, 19, 33, 'N'),
(62, 19, 34, 'N'),
(63, 19, 35, 'N'),
(64, 19, 36, 'N'),
(65, 19, 37, 'N'),
(66, 19, 38, 'N'),
(67, 20, 30, 'N'),
(68, 20, 31, 'O'),
(69, 20, 32, 'O'),
(70, 7, 32, 'N'),
(71, 37, 62, 'N'),
(72, 7, 71, 'N'),
(73, 7, 72, 'N'),
(74, 7, 44, 'N'),
(75, 7, 73, 'N'),
(76, 7, 74, 'N'),
(77, 7, 8, 'N'),
(78, 21, 46, 'N'),
(79, 22, 65, 'N'),
(80, 22, 66, 'N'),
(81, 22, 67, 'N'),
(82, 23, 55, 'N'),
(83, 24, 56, 'N'),
(84, 25, 57, 'N'),
(85, 25, 58, 'N'),
(86, 25, 59, 'N'),
(87, 25, 56, 'N'),
(88, 26, 60, 'N'),
(89, 27, 61, 'N'),
(90, 28, 62, 'N'),
(91, 29, 63, 'N'),
(92, 30, 64, 'N'),
(93, 31, 33, 'N'),
(118, 3, 75, 'N'),
(119, 5, 82, 'O'),
(128, 6, 3, 'N'),
(129, 6, 6, 'N'),
(130, 6, 8, 'N'),
(131, 6, 79, 'N'),
(132, 6, 78, 'N'),
(133, 6, 74, 'N'),
(134, 6, 76, 'N'),
(135, 6, 77, 'N'),
(136, 33, 86, 'N'),
(137, 34, 84, 'N'),
(138, 34, 85, 'O'),
(139, 35, 81, 'N'),
(140, 35, 80, 'N'),
(141, 36, 19, 'N'),
(142, 36, 83, 'N'),
(144, 32, 79, 'N'),
(145, 32, 87, 'N'),
(146, 32, 88, 'N'),
(147, 32, 89, 'N'),
(148, 32, 90, 'N');

-- --------------------------------------------------------

--
-- Structure de la table `categorie`
--

DROP TABLE IF EXISTS `categorie`;
CREATE TABLE IF NOT EXISTS `categorie` (
  `idCat` varchar(4) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `nomCat` varchar(25) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`idCat`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `categorie`
--

INSERT INTO `categorie` (`idCat`, `nomCat`) VALUES
('CAT1', 'Cat 1'),
('CAT2', 'Cat 2'),
('CAT3', 'Cat 3'),
('CAT4', 'Cat 4'),
('FOSS', 'Fosse'),
('GRAD', 'Gradin');

-- --------------------------------------------------------

--
-- Structure de la table `evenement`
--

DROP TABLE IF EXISTS `evenement`;
CREATE TABLE IF NOT EXISTS `evenement` (
  `idEvent` int NOT NULL AUTO_INCREMENT,
  `nomEvent` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` date NOT NULL,
  `lieu` int NOT NULL,
  `type` varchar(3) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `placement` varchar(4) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `pPartie` int NOT NULL,
  `affiche` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `cover` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `prixBillet` double NOT NULL,
  PRIMARY KEY (`idEvent`),
  KEY `Evenement_lieu_fkey` (`lieu`),
  KEY `Evenement_type_fkey` (`type`),
  KEY `placement` (`placement`)
) ENGINE=InnoDB AUTO_INCREMENT=38 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `evenement`
--

INSERT INTO `evenement` (`idEvent`, `nomEvent`, `date`, `lieu`, `type`, `placement`, `pPartie`, `affiche`, `cover`, `prixBillet`) VALUES
(1, 'The Final Show', '2025-05-10', 2, 'CON', 'CAT1', 0, 'https://pbs.twimg.com/media/GAQEeS9W8AAGhwo.jpg:large', 'https://dynamicmedia.livenationinternational.com/u/i/y/fd66a47c-ea5d-439c-b07d-e61a172b2e19.png', 86),
(2, 'The Monolyth Tour', '2025-06-21', 1, 'CON', 'CAT1', 0, 'https://www.myprovence.fr/sites/default/files/poi/6922678/22418411_2024-05-21T07204911700022828707.jpg', 'https://dynamicmedia.livenationinternational.com/e/s/j/1a092c1e-d458-4b03-b32f-744807fe5951.jpg', 70.5),
(3, 'Amsterdam Music Festival', '2024-10-19', 4, 'FES', 'FOSS', 0, 'https://edmnomad.com/wp-content/uploads/2024/06/AMF-2024-Line-Up-FB-Event-Banner-1920x1080-1-1024x576.jpg', 'https://amf-festival.com/wp-content/uploads/2024/10/241020-014817-AMF2024-8660-TD-scaled.jpg', 87),
(4, 'Touquet Music Beach Festival', '2023-08-26', 11, 'FES', 'FOSS', 0, 'https://sortir-prod.s3-eu-west-1.amazonaws.com/uploads/events/covers/medium/9a6aaecacdeffd85f5a92bc43333119e8979296a.jpg?1685020299', 'https://handsupelectro.fr/wp-content/uploads/2023/09/pPIwGANY.jpeg', 55),
(5, 'Kygo World Tour', '2024-12-07', 3, 'CON', 'CAT2', 0, 'https://img.nrj.fr/hbapIt-iTkqsOK-XGlOroSUQZHQ=/medias%2F2024%2F04%2F3vud7ajqftqosz5a4eo4f7unbnyqykx5ko6nlleknia_662661b2462d8.jpg', 'https://assets0.dostuffmedia.com/uploads/aws_asset/aws_asset/21733568/b2558e74-2529-41db-bade-31283c56e76b.jpg', 69),
(6, 'Tomorrowland Our Story', '2024-10-18', 5, 'SOI', 'GRAD', 0, 'https://cdn.uc.assets.prezly.com/31de40c1-7815-4643-9cb6-1e251c06fd44/-/resize/1108x/-/quality/best/-/format/auto/', 'https://prismic-assets-cdn.tomorrowland.com/Zynq_q8jQArT0MNT_241018-234230-TML_OURSTORY-08453-HR-JT-min.jpg?width=1600', 55),
(7, 'Tomorrowland Belgique 2024 Lyfe', '2024-07-20', 6, 'FES', 'FOSS', 0, 'https://akkros.com/images/voyages/tomorrowland_weekend_2_2024.png?6519177', 'https://cdn.uc.assets.prezly.com/aabab785-d885-4a23-9191-ac86a2bc8afb/-/preview/1200x1200/-/format/auto/', 159),
(8, 'Chambord Live : David Guetta', '2024-06-29', 7, 'FES', 'FOSS', 0, 'https://cdn1.chambord.org/fr/wp-content/uploads/sites/2/2023/12/affiche.jpg', 'https://cdn.prod.website-files.com/6478537901c5003e7d5b2d14/66a0f3f5d3adc04daa084728_20240629223801__M9A8315.jpg', 79),
(9, 'The Eras Tour', '2024-06-03', 8, 'CON', 'CAT3', 0, 'https://img.leboncoin.fr/api/v1/lbcpb1/images/82/cf/30/82cf30939c271ad3f4f187ec258d8b9f06cd4f4e.jpg?rule=ad-image', 'https://resize.programme-television.org/original/var/premiere/storage/images/news/streaming/disney-plus/taylor-swift-the-eras-tour-le-film-de-la-tournee-historique-cree-l-evenement-sur-disney-video-4725922/102763852-1-fre-FR/Taylor-Swift-The-Eras-Tour-le-film-de-la-tournee-historique-cree-l-evenement-sur-Disney-VIDEO.jpg', 91),
(10, 'Think Later Tour', '2024-04-30', 9, 'CON', 'FOSS', 0, 'https://images.lesindesradios.fr/fit-in/1100x2000/filters:format(webp)/medias/7cwFGTQgm9/image/Tate_21701891164118.jpg', 'https://www.instyle.com/thmb/o14JY9or4AqVccGZ0VizjWR68a0=/1500x0/filters:no_upscale():max_bytes(150000):strip_icc()/GettyImages-2161719037-d91213d43cbe4fe8a811a54b28892b1d.jpg', 43),
(11, 'Fun Radio Ibiza Experience 2024', '2024-04-05', 3, 'FES', 'FOSS', 0, 'https://cmsphoto.ww-cdn.com/superstatic/36765/art/grande/77904664-56581509.jpg?v=1705739780', 'https://images.rtl.fr/~c/1200v800/funradio/www/1667838-martin-solveig-mixe-a-l-accor-arena.jpeg', 62),
(12, 'Fun Radio Ibiza Experience 2023', '2023-04-28', 3, 'FES', 'GRAD', 0, 'https://images.rtl.fr/funradio/www/1578525-frie.jpg', 'https://images.rtl.fr/~c/2000v2000/funradio/www/1444199-l-edition-2019-de-fun-radio-ibiza-experience.jpg', 57),
(13, 'Ofenbach : One live', '2023-10-28', 10, 'CON', 'FOSS', 0, 'https://assets.leparisien.fr/website/etudiant/evenements/recto_flyer/2023/10/2726055_ofenbach-zenith.jpg', 'https://images.lesindesradios.fr/filters:format(webp)/medias/Vsj0LZpM34/image/Capture_d_e_cran_2024_05_24_a__15_19_001716556803970-format16by9.png', 44),
(14, 'The After Hours Til Dawn Tour', '2023-07-29', 2, 'CON', 'CAT2', 0, 'https://files.offi.fr/programmation/2164809/images/600/5bef015967210f7fc4c3022bfa266835.jpg', 'https://awardsradar.com/wp-content/uploads/2023/06/the-weeknd-live-at-sofi-stadium_0-1.jpg', 110),
(15, 'Main Square 2023', '2023-06-30', 13, 'FES', 'FOSS', 0, 'https://www.concerts-metal.com/images/flyers/202303/1679387514.webp', 'https://lvdneng.rosselcdn.net/sites/default/files/dpistyles_v2/vdn_864w/2023/07/01/node_1347182/56351695/public/2023/07/01/B9734653191Z.1_20230701002608_000%2BGD9N2G5B5.4-0.jpg?itok=LgFsnYPJ1688194571', 69),
(16, 'Lollapalooza 2023', '2023-07-22', 12, 'FES', 'FOSS', 0, 'https://leclaireur.fnac.com/wp-content/uploads/2022/12/lollapalooza-paris-724x1024.jpg', 'https://www.frequence3.com/wp-content/uploads/2023/04/Lollapalooza-Paris-2023.png', 89),
(17, 'On tour (Finally)', '2023-04-24', 14, 'CON', 'FOSS', 0, 'https://img.nrj.fr/9W3ij1n7Fffdiua9ewpI3mi4aAA=/medias%2F2023%2F02%2Ftl0sv75y08mjafzq8utmvedypkporspz8s21mncgtei_63fc850f147a7.jpg', 'https://variety.com/wp-content/uploads/2022/12/CJP18267-1.jpg', 29),
(18, 'Nonante-cinq Tour', '2022-11-21', 15, 'CON', 'FOSS', 0, 'https://www.label-ln.fr/images/images_spectacles/spectacle502_detail.jpg', 'https://cloudfront-eu-central-1.images.arcpublishing.com/leparisien/AVLA3VGDXVD37NI4RRJFESMQBM.jpg', 39),
(19, 'Paranormal Festival', '2022-10-27', 15, 'FES', 'FOSS', 0, 'https://cdn.prod.website-files.com/60df1b26ef94b3de3f751a57/634fe00ea4de6e7cae48d241_paranormal-festival-20220920170333.jpg', 'https://res.cloudinary.com/shotgun/image/upload/v1664199305/production/artworks/Paranormal_cover_svj5oy.jpg', 30),
(20, 'Walkerverse Tour', '2022-10-01', 14, 'CON', 'FOSS', 0, 'https://www.clickmagazine.co.uk/wp-content/uploads/2022/05/7dfab1f8-6749-8eb4-aa85-8da057511196-1024x1024.png', 'https://rollingstoneindia.com/wp-content/uploads/2023/07/Alan-Walker-live.jpg', 36),
(21, 'Les Briques Rouges 2023', '2022-09-23', 16, 'FES', 'FOSS', 0, 'https://lh4.googleusercontent.com/proxy/xwFnRlcnFM2GI7sZG3lQXHvG0r4vCryURzEff7UhOfRJ-BPoMtjXtFq-wLBVEBEfIa04OXq0-Om6HglNLvIM3pRFdL3ZOZZnTJw', 'https://www.lesbriquesrouges.fr/_nuxt/img/qui-sommes-nous1.c829b90.jpg', 31),
(22, 'Europe 1 Tourcoing', '2022-09-16', 17, 'FES', 'FOSS', 0, 'https://www.zoomsurlille.fr/wp-content/uploads/2023/05/europe_2_live_01.jpg', 'https://lvdneng.rosselcdn.net/sites/default/files/dpistyles_v2/ena_16_9_extra_big/2024/06/05/node_1469409/59181329/public/2024/06/05/18922100.jpeg?itok=Gnu6fGPZ1717614520', 0),
(23, 'Robin des bois', '2014-02-09', 15, 'COM', 'GRAD', 0, 'https://static.fnac-static.com/multimedia/Images/FR/NR/6f/e8/5f/6285423/1507-1/tsp20140912102038/Robin-des-bois-DVD.jpg', 'https://cdn-s-www.leprogres.fr/images/47B592A5-8909-4B40-83F3-0736CCE91150/NW_raw/photo-dr-1389731138.jpg', 45),
(24, 'A l\'infini Tour', '2014-03-22', 15, 'CON', 'GRAD', 0, 'https://www.cgrevents.com/sites/default/files/concert_tal.jpg', 'https://medias.objectifgard.com/api/v1/images/view/636b584254b1310ed6344e66/article/image.jpg', 39),
(25, 'Fourmies live', '2015-07-03', 18, 'FES', 'FOSS', 0, 'https://storage.canalblog.com/52/99/783846/105057230_o.jpg', 'https://live.staticflickr.com/8888/28201662896_fd8ea9a0ab_h.jpg', 29),
(26, 'Black M', '2019-08-15', 13, 'CON', 'FOSS', 0, 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTSRcmJh8Lh8sVzStOw15cfz6oTzy4ocW13Tg&s', 'https://lvdneng.rosselcdn.net/sites/default/files/dpistyles_v2/vdn_864w/2019/08/16/node_625334/40455249/public/2019/08/16/B9720584720Z.1_20190816003243_000%2BGCJE8L109.3-0.jpg?itok=AtWEWDzR1565942462', 0),
(27, 'Aya Nakamura', '2019-10-20', 19, 'SHO', 'FOSS', 0, 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTrxUR3dYRZ3FNEr0nGLnezAgDUh0iHzcwQWQ&s', 'https://static.actu.fr/uploads/2019/11/aya-nakamura-cours-de-danse-gare-saint-sauveur-bistrot-st-so-lille.jpg', 0),
(28, 'Future Nostalgia Tour', '2022-05-07', 20, 'CON', 'GRAD', 0, 'https://upload.wikimedia.org/wikipedia/en/8/8f/Future_Nostalgia_Tour_poster.png', 'https://www.kekelmb.com/wp-content/uploads/2022/03/kekeLMB_DuaLipa_FutureNostalgiaTour_PrudentialCenter_Newark_2022_gallery-32.jpg', 85.5),
(29, 'La tournée événement sexion d\'assaut', '2022-06-12', 15, 'CON', 'FOSS', 0, 'https://www.zenith-amiens.fr/fileadmin/_processed_/6/6/csm_Sexion_-_40x60_tournee_WEB_846dd3a092.jpg', 'https://images.laprovence.com/media/hermes/2022-06/2022-06-13/20220613_1_6_1_1_0_obj26322322_1.jpg?twic=v1/crop=1800x990@0x266/cover=820x461', 49),
(30, 'Robin Schuldz', '2022-08-11', 21, 'SHO', 'FOSS', 0, 'https://icisete.fr/wp-content/uploads/2023/11/DJ-Robin-Schulz-Amnesia-Cap-dAgde.jpg', 'https://www.prysmradio.com/wp-content/uploads/2022/07/Amnesia-Cap-dAgde.jpeg', 21),
(31, 'DJ Bens', '2022-08-21', 21, 'SHO', 'FOSS', 0, 'https://icisete.fr/wp-content/uploads/2023/11/Dj-Bens-Amnesia-Cap-dAgde.jpg', 'https://valliue.com/wp-content/uploads/2019/06/amnesia.jpg', 21),
(32, 'Tomorrowland Belgique 2025 Orbyz', '2025-07-25', 6, 'FES', 'FOSS', 0, 'https://cdn.uc.assets.prezly.com/3e9bda7e-8dc4-4cf9-aa3d-72867a46e256/-/resize/1108x/-/quality/best/-/format/auto/', 'https://prismic-assets-cdn.tomorrowland.com/Z0cY8pbqstJ970TH_TL25-THEME-ANNOUNCEMENT-SocialAssets-Mailing-header.png', 225),
(33, 'The Lifetimes Tour', '2025-10-24', 3, 'CON', 'CAT3', 0, 'https://image-cdn-ak.spotifycdn.com/image/ab67706c0000da84315d0891e84826d0ddeee423', 'https://www.chartsinfrance.net/communaute/uploads/monthly_2024_09/IMG_2019.jpeg.ef61ae88e6ddfd694985f5c322241906.jpeg', 67),
(34, 'Loom World Tour', '2025-07-23', 22, 'CON', 'CAT4', 0, 'https://i.ebayimg.com/images/g/gRsAAOSw8l9mybQO/s-l1600.jpg', 'https://www.eventim.de/obj/media/DE-eventim/teaser/artworks/2024/imagine-dragons-tickets-header.jpg', 85),
(35, '30 ans Zenith Lille', '2024-11-26', 15, 'CON', 'FOSS', 0, 'https://www.zoomsurlille.fr/wp-content/uploads/2024/09/feder_lgp_30_ans_02.jpg', 'https://www.lille.fr/var/www/storage/images/mediatheque/mairie-de-lille/actualites/objets-multimedia/galeries-d-images/2024/novembre-2024/soiree-des-30-ans-de-lille-grand-palais/soiree-des-30-ans-de-lille-grand-palais3/3640130-1-fre-FR/Soiree-des-30-ans-de-Lille-Grand-Palais_news_image_top.jpg', 0),
(36, 'Meduza & James Hype Present Our House', '2025-04-04', 24, 'SOI', 'FOSS', 0, 'https://scontent-cdg4-1.xx.fbcdn.net/v/t51.75761-15/475025231_18265948981270405_6839495521202158324_n.jpg?_nc_cat=108&ccb=1-7&_nc_sid=127cfc&_nc_ohc=sUabVjo1nsUQ7kNvgHGeool&_nc_zt=23&_nc_ht=scontent-cdg4-1.xx&_nc_gid=AiTkvbYO7YzxX3Ewv9iEBPL&oh=00_AYB3ozJMDgGnQdE9JhzPjeWYiH-A0yJZAO-gC83Qei6DkQ&oe=67A4696A', 'https://res.cloudinary.com/shotgun/image/upload/c_limit,w_3840/fl_lossy/f_auto/q_auto/production/artworks/FLYER_PHANTOM_ybnb0a.jpg', 30),
(37, 'Radical Optimism Tour', '2025-05-23', 23, 'CON', 'CAT2', 0, 'https://img.nrj.fr/R9aQyZ3eY_HbLKsO9HxB2tK33BU=/medias%2F2024%2F09%2Fttueonff6tipuk3odh2uemftkygoimy5n4j6lzufhoe_66e4066cf30b3.jpg', 'https://www.lilithia.net/wp-content/uploads/2024/10/dualipa_1920x1080au.jpg', 84);

-- --------------------------------------------------------

--
-- Structure de la table `lieu`
--

DROP TABLE IF EXISTS `lieu`;
CREATE TABLE IF NOT EXISTS `lieu` (
  `idLieu` int NOT NULL AUTO_INCREMENT,
  `nomLieu` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `ville` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `pays` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `photoLieu` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  PRIMARY KEY (`idLieu`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `lieu`
--

INSERT INTO `lieu` (`idLieu`, `nomLieu`, `ville`, `pays`, `photoLieu`) VALUES
(1, 'Vélodrome Orange', 'Marseille', 'France', 'https://leclaireur.fnac.com/wp-content/uploads/2024/04/velodrome-stade-1256x826.jpg'),
(2, 'Stade de France', 'Saint-Denis', 'France', 'https://www.bouygues-construction.com/blog/wp-content/uploads/001480206239an001h1274956790398183271.png-1_-1xoxar.png'),
(3, 'Accor Arena', 'Paris', 'France', 'https://cdn.sortiraparis.com/images/80/97166/724838-champion-des-pistes-des-animations-sportives-gratuites-autour-des-jo-a-tester-a-l-accor-arena.jpg'),
(4, 'Johan Cruijff Arena', 'Amsterdam', 'Pays-Bas', 'https://www.casala.com/wp-content/uploads/2020/07/s-johan-cruijff-arena-2.jpg'),
(5, 'Ziggo Dome', 'Amsterdam', 'Pays-Bas', 'https://d1ize34iqy408p.cloudfront.net/images/ZiggoDome-2016_verkleind.width-2560.webp'),
(6, 'Domaine provincial De Schorre', 'Boom', 'Belgique', 'https://climbfinder.com/CDN/de-schorre-boom-upload-6192-1024x0.jpg'),
(7, 'Chateau de Chambord', 'Chambord', 'France', 'https://www.val-de-loire-41.com/wp-content/uploads/2023/10/chambord-septembre-2023-dnc-olivier-marchant-1-1600x900.jpg'),
(8, 'Groupama Stadium', 'Lyon', 'France', 'https://media.lyon-france.com/1280x764/5042888/9983786.jpg'),
(9, 'Lotto Arena', 'Anvers', 'Belgique', 'https://antwerpconventionbureau.be/wp-content/uploads/2017/06/13_LOTTOARENApanoramainside.jpg'),
(10, 'Zenith Paris La Villette', 'Paris', 'France', 'https://cdn.sortiraparis.com/images/80/100773/962281-visuels-salles-de-spectacle-et-theatres-zenith-paris.jpg'),
(11, 'LOrangerie de la Baie', 'Le Touquet Paris Plage', 'France', 'https://www.hautsdefrancemeetings.com/wp-content/uploads/2022/09/Orangerie-Le-TouquetCo-Nicodeme-Leclercq-1-scaled.jpg'),
(12, 'Hippodrome Paris Longchamp', 'Paris', 'France', 'https://www.oteis.fr/wp-content/uploads/2016/03/photo_1.jpg'),
(13, 'Citadelle d Arras', 'Arras', 'France', 'https://www.arrasville.fr/wp-content/uploads/2022/05/porte-quartier-turenne-citadelle-arras.jpg'),
(14, 'Ancienne Belgique', 'Bruxelles', 'Belgique', 'https://www.abconcerts.be/media/cache/ogimage/upload/media/default/ae/bac1fb6bb046353975be4e56a0737cf47b820a13.jpg'),
(15, 'Zenith Lille', 'Lille', 'France', 'https://upload.wikimedia.org/wikipedia/commons/1/18/Z%C3%A9nith_de_Lille_2014.JPG'),
(16, 'Château Dalle Dumont', 'Wervicq-Sud', 'France', 'https://www.wervicq-sud.com/wp-content/uploads/2021/02/chateau-et-parc-dalle-dumont.jpg'),
(17, 'Parvis St Christophe', 'Tourcoing', 'France', 'https://locations.filmfrance.net/sites/default/files/photos/ville-de-tourcoing-centre-127889/photo165696.jpg'),
(18, 'Site des Verreries', 'Fourmies', 'France', 'https://www.fourmies.fr/upload/sliders/34229_IMG-6915.jpg'),
(19, 'Euralille', 'Lille', 'France', 'https://cdn.urw.com/france/euralille/-/media/Unibail/Country~o~FR/Euralille/dZ55JJewjpeg.jpg?mh=1333&mw=2000&revision=dd638111-9f9c-45c8-9f11-122f5697424d&hash=C5FF6E5EFEBD2D69DC13CEB3FB145F2F'),
(20, 'Sportpaleis Antwerpen', 'Anvers', 'Belgique', 'https://img.standaard.be/E2OlX4lDJ6krgtPT8EtxkBydniU=/640x427/smart/https%3A%2F%2Fstatic.standaard.be%2FAssets%2FImages_Upload%2F2014%2F01%2F31%2Fea58a3b6-8a98-11e3-a965-d230c9a3b817_web_scale_0.0976563_0.0976563__.jpg'),
(21, 'Amnésia', 'Cap d Agde', 'France', 'https://cdn-s-www.lejsl.com/images/222ae107-cb8e-497e-8fa6-9a09c961cd67/NW_raw/gregory-boudou-est-le-gerant-de-la-discotheque-l-amnesia-fondee-par-son-pere-andre-boudou-au-cap-d-agde-photo-afp-1522871600.jpg'),
(22, 'Décathlon Aréna Stade Pierre Mauroy', 'Lille', 'France', 'https://www.ostadium.com/galleries/stade-pierre-mauroy-illus.jpg'),
(23, 'La Défense Arena', 'Nanterre', 'France', 'https://www.grandearche.com/wp-content/uploads/2020/02/u-arena-1-600x336.jpg'),
(24, 'Phantom Accor Arena', 'Paris', 'France', 'https://i0.wp.com/paris-society.com/fr/uploads/sites/2/2024/04/02-Phantom-Club.jpg?ssl=1&w=2500&quality=85');

-- --------------------------------------------------------

--
-- Structure de la table `type`
--

DROP TABLE IF EXISTS `type`;
CREATE TABLE IF NOT EXISTS `type` (
  `idType` varchar(3) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `nomType` varchar(25) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`idType`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `type`
--

INSERT INTO `type` (`idType`, `nomType`) VALUES
('COM', 'Comédie musicale'),
('CON', 'Concert'),
('FES', 'Festival'),
('SHO', 'Showcase'),
('SOI', 'Soirée');

-- --------------------------------------------------------

--
-- Structure de la table `type_lieu`
--

DROP TABLE IF EXISTS `type_lieu`;
CREATE TABLE IF NOT EXISTS `type_lieu` (
  `idType` varchar(3) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `nomType` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`idType`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `association`
--
ALTER TABLE `association`
  ADD CONSTRAINT `association_ibfk_1` FOREIGN KEY (`artiste`) REFERENCES `artiste` (`idArtiste`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `association_ibfk_2` FOREIGN KEY (`evenement`) REFERENCES `evenement` (`idEvent`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Contraintes pour la table `evenement`
--
ALTER TABLE `evenement`
  ADD CONSTRAINT `evenement_ibfk_1` FOREIGN KEY (`lieu`) REFERENCES `lieu` (`idLieu`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `evenement_ibfk_2` FOREIGN KEY (`type`) REFERENCES `type` (`idType`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `evenement_ibfk_3` FOREIGN KEY (`placement`) REFERENCES `categorie` (`idCat`) ON DELETE RESTRICT ON UPDATE RESTRICT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
