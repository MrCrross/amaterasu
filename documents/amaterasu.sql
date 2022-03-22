-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1
-- Время создания: Мар 22 2022 г., 10:09
-- Версия сервера: 10.4.22-MariaDB
-- Версия PHP: 7.4.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `amaterasu`
--

-- --------------------------------------------------------

--
-- Структура таблицы `clients`
--

CREATE TABLE `clients` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `last_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `first_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(16) COLLATE utf8mb4_unicode_ci NOT NULL,
  `birthday` date DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `clients`
--

INSERT INTO `clients` (`id`, `last_name`, `first_name`, `email`, `phone`, `birthday`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 'Иванова', 'Юлия', 'mrcrross38@vk.com', '+7(964)659-29-99', '2000-05-03', 3, '2022-03-22 02:08:10', '2022-03-22 02:08:10');

-- --------------------------------------------------------

--
-- Структура таблицы `contraindications`
--

CREATE TABLE `contraindications` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `contraindications`
--

INSERT INTO `contraindications` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'беременность и кормление грудью', '2022-03-22 02:08:13', '2022-03-22 02:08:13'),
(2, 'аутоиммунные заболевания', '2022-03-22 02:08:13', '2022-03-22 02:08:13'),
(3, 'гемофилия', '2022-03-22 02:08:13', '2022-03-22 02:08:13'),
(4, 'обострение герпеса', '2022-03-22 02:08:13', '2022-03-22 02:08:13');

-- --------------------------------------------------------

--
-- Структура таблицы `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `indications`
--

CREATE TABLE `indications` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `indications`
--

INSERT INTO `indications` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'сухая,обезвоженная кожа', '2022-03-22 02:08:12', '2022-03-22 02:08:12'),
(2, 'морщины', '2022-03-22 02:08:12', '2022-03-22 02:08:12'),
(3, 'возрастная кожа', '2022-03-22 02:08:12', '2022-03-22 02:08:12'),
(4, 'пигментация', '2022-03-22 02:08:12', '2022-03-22 02:08:12'),
(5, 'кожа «курильщика»', '2022-03-22 02:08:12', '2022-03-22 02:08:12'),
(6, 'профилактика преждевременного старения', '2022-03-22 02:08:12', '2022-03-22 02:08:12'),
(7, 'акне', '2022-03-22 02:08:12', '2022-03-22 02:08:12'),
(8, 'жирная кожа,склонная к воспалениям', '2022-03-22 02:08:12', '2022-03-22 02:08:12'),
(9, 'целлюлит', '2022-03-22 02:08:13', '2022-03-22 02:08:13'),
(10, 'коррекция жировых отложений', '2022-03-22 02:08:13', '2022-03-22 02:08:13');

-- --------------------------------------------------------

--
-- Структура таблицы `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2019_08_19_000000_create_failed_jobs_table', 1),
(3, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(4, '2022_03_01_043341_create_permission_tables', 1),
(5, '2022_03_02_032129_create_posts_table', 1),
(6, '2022_03_02_032215_create_service_types_table', 1),
(7, '2022_03_02_032216_create_services_table', 1),
(8, '2022_03_02_032310_create_clients_table', 1),
(9, '2022_03_02_032337_create_workers_table', 1),
(10, '2022_03_02_032447_create_orders_table', 1),
(11, '2022_03_02_074404_create_worker_services_table', 1),
(12, '2022_03_11_133207_create_indications_table', 1),
(13, '2022_03_11_133233_create_contraindications_table', 1),
(14, '2022_03_11_133312_create_service_contraindications_table', 1),
(15, '2022_03_11_133330_create_service_indications_table', 1),
(16, '2022_03_14_150538_create_records_table', 1);

-- --------------------------------------------------------

--
-- Структура таблицы `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(1, 'App\\Models\\User', 1),
(2, 'App\\Models\\User', 4),
(3, 'App\\Models\\User', 3),
(4, 'App\\Models\\User', 2);

-- --------------------------------------------------------

--
-- Структура таблицы `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `seance` datetime NOT NULL,
  `status` tinyint(1) NOT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `service_id` bigint(20) UNSIGNED NOT NULL,
  `worker_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'role-list', 'web', '2022-03-22 02:08:04', '2022-03-22 02:08:04'),
(2, 'role-create', 'web', '2022-03-22 02:08:04', '2022-03-22 02:08:04'),
(3, 'role-edit', 'web', '2022-03-22 02:08:04', '2022-03-22 02:08:04'),
(4, 'role-delete', 'web', '2022-03-22 02:08:04', '2022-03-22 02:08:04'),
(5, 'user-list', 'web', '2022-03-22 02:08:04', '2022-03-22 02:08:04'),
(6, 'user-create', 'web', '2022-03-22 02:08:04', '2022-03-22 02:08:04'),
(7, 'user-edit', 'web', '2022-03-22 02:08:04', '2022-03-22 02:08:04'),
(8, 'user-delete', 'web', '2022-03-22 02:08:04', '2022-03-22 02:08:04'),
(9, 'order-list', 'web', '2022-03-22 02:08:04', '2022-03-22 02:08:04'),
(10, 'order-client-list', 'web', '2022-03-22 02:08:04', '2022-03-22 02:08:04'),
(11, 'order-worker-list', 'web', '2022-03-22 02:08:05', '2022-03-22 02:08:05'),
(12, 'order-create', 'web', '2022-03-22 02:08:05', '2022-03-22 02:08:05'),
(13, 'order-edit', 'web', '2022-03-22 02:08:05', '2022-03-22 02:08:05'),
(14, 'order-delete', 'web', '2022-03-22 02:08:05', '2022-03-22 02:08:05'),
(15, 'service-create', 'web', '2022-03-22 02:08:05', '2022-03-22 02:08:05'),
(16, 'service-edit', 'web', '2022-03-22 02:08:05', '2022-03-22 02:08:05'),
(17, 'service-delete', 'web', '2022-03-22 02:08:05', '2022-03-22 02:08:05'),
(18, 'worker-create', 'web', '2022-03-22 02:08:05', '2022-03-22 02:08:05'),
(19, 'worker-edit', 'web', '2022-03-22 02:08:05', '2022-03-22 02:08:05'),
(20, 'worker-delete', 'web', '2022-03-22 02:08:05', '2022-03-22 02:08:05'),
(21, 'post-create', 'web', '2022-03-22 02:08:05', '2022-03-22 02:08:05'),
(22, 'post-edit', 'web', '2022-03-22 02:08:05', '2022-03-22 02:08:05'),
(23, 'post-delete', 'web', '2022-03-22 02:08:05', '2022-03-22 02:08:05'),
(24, 'type-create', 'web', '2022-03-22 02:08:05', '2022-03-22 02:08:05'),
(25, 'type-edit', 'web', '2022-03-22 02:08:05', '2022-03-22 02:08:05'),
(26, 'type-delete', 'web', '2022-03-22 02:08:05', '2022-03-22 02:08:05'),
(27, 'record-list', 'web', '2022-03-22 02:08:06', '2022-03-22 02:08:06'),
(28, 'record-update', 'web', '2022-03-22 02:08:06', '2022-03-22 02:08:06'),
(29, 'indication-create', 'web', '2022-03-22 02:08:06', '2022-03-22 02:08:06'),
(30, 'indication-edit', 'web', '2022-03-22 02:08:06', '2022-03-22 02:08:06'),
(31, 'indication-delete', 'web', '2022-03-22 02:08:06', '2022-03-22 02:08:06'),
(32, 'contraindication-create', 'web', '2022-03-22 02:08:06', '2022-03-22 02:08:06'),
(33, 'contraindication-edit', 'web', '2022-03-22 02:08:06', '2022-03-22 02:08:06'),
(34, 'contraindication-delete', 'web', '2022-03-22 02:08:06', '2022-03-22 02:08:06');

-- --------------------------------------------------------

--
-- Структура таблицы `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `posts`
--

CREATE TABLE `posts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `posts`
--

INSERT INTO `posts` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Врач-косметолог', '2022-03-22 02:08:08', '2022-03-22 02:08:08'),
(2, 'Приемная', '2022-03-22 02:08:09', '2022-03-22 02:08:09');

-- --------------------------------------------------------

--
-- Структура таблицы `records`
--

CREATE TABLE `records` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `last_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `first_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(16) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `service_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'Администратор', 'web', '2022-03-22 02:08:06', '2022-03-22 02:08:06'),
(2, 'Приемная', 'web', '2022-03-22 02:08:09', '2022-03-22 02:08:09'),
(3, 'Клиент', 'web', '2022-03-22 02:08:09', '2022-03-22 02:08:09'),
(4, 'Врач', 'web', '2022-03-22 02:08:09', '2022-03-22 02:08:09');

-- --------------------------------------------------------

--
-- Структура таблицы `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `role_has_permissions`
--

INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES
(1, 1),
(2, 1),
(3, 1),
(4, 1),
(5, 1),
(6, 1),
(7, 1),
(8, 1),
(9, 1),
(9, 2),
(10, 1),
(10, 3),
(11, 1),
(11, 4),
(12, 1),
(13, 1),
(14, 1),
(15, 1),
(16, 1),
(17, 1),
(18, 1),
(19, 1),
(20, 1),
(21, 1),
(22, 1),
(23, 1),
(24, 1),
(25, 1),
(26, 1),
(27, 1),
(27, 2),
(28, 1),
(28, 2),
(29, 1),
(30, 1),
(31, 1),
(32, 1),
(33, 1),
(34, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `services`
--

CREATE TABLE `services` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `img` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` int(10) UNSIGNED NOT NULL,
  `service_type_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `services`
--

INSERT INTO `services` (`id`, `name`, `img`, `description`, `price`, `service_type_id`, `created_at`, `updated_at`) VALUES
(1, 'Первичная консультация врача косметолога', 'storage/services/1.jpg', 'Первичная консультация дерматолога-косметолога обычно проходит по общей схеме: специалист выслушивает пациента, выясняет наличие аллергических реакций и список имеющихся заболеваний, спрашивает, какими косметическими средствами он пользуется. После этого проводится визуальный осмотр пациента и - при необходимости - назначаются дополнительные консультации специалистов, например, эндокринолога или проведение анализов.\nПосле проведённых обследований и диагностики, врач-косметолог разрабатывает оптимальную для пациента схему коррекции дефекта. Она может включать подбор уходовых средств, проведение инъекционных или аппаратных процедур, курс различных массажей. Кроме того, квалификация дерматологов-косметологов позволяет при необходимости рекомендовать и назначать пациенту лекарственные средства, предназначенные для лечения проблем с кожей, обеспечивая комплексный подход в их диагностике и лечении. То есть, консультация дерматолога-косметолога необходима для профессиональной оценки возрастных или других эстетических проблем с кожей и индивидуального подбора методик по их коррекции.', 1300, 1, '2022-03-22 02:08:11', '2022-03-22 02:08:11'),
(2, 'Комбинированная чистка лица (Космотерос)', 'storage/services/2.jpg', 'Для тех, кто привык к старому методу чистки, предлагаем чистку с распариванием кожи. Сюда входит демакияж, пилинг – броссаж, механическая чистка, дарсонваль, маска.', 1800, 2, '2022-03-22 02:08:11', '2022-03-22 02:08:11'),
(3, 'Атравматичная чистка лица на Израильской косметики (Холи Лэнд)', 'storage/services/3.jpg', 'Процедура, цель которой очистить и сократить поры, традиционно называется чисткой кожи. Распаривание кожи с помощью горячего пара и механическое удаление содержимого пор с помощью пальцев - весьма болезненная процедура. Поэтому, используя израильскую косметику «Холи Лэнд» мы стараемся сделать чистку максимально эффективной и при этом минимально травмирующей.\nПреимущество данной чистки заключается в отсутствии распаривания, для разогрева кожи и размягчения сальных пробок используются специальные лосьоны и растворы, высокий уровень антисептики,возможна локальная обработка кожи, возможность работы с сухой и чувствительной кожи.\nОсновные эффекты процедуры - очищение пор, выравнивание цвета и текстуры кожи, заживление воспалительных элементов, профилактика воспалений.\nЭтапы чистки - демакияж, фруктовый пилинг, подготовка кожи с помощью лосьонов и растворов, механическая чистка, молочный энзимный пилинг, маска - 1,5-2 часа', 2500, 2, '2022-03-22 02:08:11', '2022-03-22 02:08:11'),
(4, 'Ультразвуковая чистка лица', 'storage/services/4.jpg', 'Для непроблемной кожи, склонной к сухости. Эта чистка выравнивает кожу, удаляет ороговевшие старые клетки с помощью ультразвука, но не решает проблему черных сальных пробок. Демакияж, энзимный пилинг, чистка с помощью ультразвука, маска - всё это по времени занимает 60 минут.', 1600, 2, '2022-03-22 02:08:11', '2022-03-22 02:08:11'),
(5, 'Контурная пластика и объемное моделирование', 'storage/services/10.jpg', 'С возрастом наши морщины становятся глубже, носогубные морщины превращаются в складки, а объемы в верхней и средней трети лица уходят, щеки опускаются, и появляются «брыли», овал становится менее четким, лицо расширяется книзу. В результате форма лица меняется, и на лице проступает возраст. На помощь приходят филлеры-препараты стабилизированной гиалуроновой кислоты, полимолочной кислоты или с частицами кальция.\nФиллер - значит заполнитель, т.е. гель вводится под морщину, выталкивая ее наружу, и в результате морщина исчезает или становится менее заметной. Но иногда коррекции морщин не хватает для эффекта омоложения, и нужно восстановить утраченные объемы, и эта процедура называется объемным или 3Д моделированием. Как правило, используются более плотные филлеры или еще их называют волюмайзеры. При правильном их введении запавшие или провисшие щеки подтягиваются и восстанавливается молодой овал.', 21000, 5, '2022-03-22 02:08:11', '2022-03-22 02:08:11'),
(6, 'Энергия чёрной икры Клапп', 'storage/services/5.jpg', 'Эксклюзивный комплекс на основе икры осетровых рыб и натуральных биопептидов разглаживает мелкие морщинки, глубоко увлажняет, восстанавливает гидролипидную мантию, повышает упругость и эластичность кожи. Включает в себя очищение, пилинг ,нанесение концентрата из экстракта водорослей, ДНК икры осетровых рыб, устриц, маска, массаж.', 2600, 3, '2022-03-22 02:08:11', '2022-03-22 02:08:11'),
(7, 'Люкс-процедура Anti-age для гурманов «Брызги шампанского»', 'storage/services/6.jpg', 'Рекомендуется для зрелой кожи после 35 лет Обеспечивает выраженный комплексный омолаживающий эффект, заполняет носогубные складки, ремоделирует овал лица, восстанавливает контур подбородка и скул, повышение эластичности кожи, снимает раздражение, укрепляет и уплотняет кожу. Включает в себя очищение, маску с кислородом, микрочастицами золота, гиалуроновой кислотой, концентрат сгексапептидом, экстрактом королевского винограда, пептидную маску,маску-мусс, массаж, крем', 5000, 3, '2022-03-22 02:08:11', '2022-03-22 02:08:11'),
(8, 'Процедура для мужчин - уход за сухой кожей', 'storage/services/7.jpg', 'глубоко увлажняет, успокаивает и стимулирует естественный процесс регенерации, дарит свежий и ухоженный вид. Такая процедура - находка для мужчин, которые ценят себя и хотят прекрасно выглядеть. Включает в себя очищение, гель пилинг, концентрат с ДНК икры осетровых рыб, экстрактом водорослей, специальную маску, массаж по релаксирующему крему, завершающий уход.', 2600, 3, '2022-03-22 02:08:12', '2022-03-22 02:08:12'),
(9, 'Микротоковая терапия тела', 'storage/services/8.jpg', 'В основе микротоковой терапии лежит импульсный электрический ток низкой частоты, всего несколько десятков микрогерц, поэтому не происходит сокращения мышц, как при электростимуляции, а воздействие идет на клеточном уровне, тем самым обеспечивая достаточно выраженный результат.\nЭффективность процедуры заключается в стимуляции кровообращения, лимфодренажной функции, ускорения деления клеток и питания их энергией. Воздействие микротоков происходит на уровне кожи, сосудов и мышц.\nМикротоки часто являются единственным спасением для проблемной кожи, усеянной высыпаниями,когда ни о каком другом вмешательстве не может быть и речи. Очень часто микротоки назначаются при отечности лица, как послеоперационная реабилитация после блефаропластики, при лечении целлюлита.', 1600, 4, '2022-03-22 02:08:12', '2022-03-22 02:08:12'),
(10, 'Ультразвуковой массаж лица', 'storage/services/9.jpg', 'Вызывает стимуляцию кожи, улучшение обменных процессов, ускорение синтеза коллагена и эластина, а также размягчение рубцов и спаечных процессов в коже при целлюлите.\nПродолжительность курса - 10-15 процедур через день или ежедневно.', 800, 4, '2022-03-22 02:08:12', '2022-03-22 02:08:12'),
(11, 'Мезотерапия', 'storage/services/11.jpg', 'Это метод лечения лица и тела с помощью внутрикожных микроинъекций. Принципы мезотерапии - редко,минимальными дозами и в нужное место, т.е. только в проблемные места. Конечно иньекции - не самое приятное мероприятие в жизни, но с другой стороны,они дают потрясающие результаты,которых невозможно добиться ни одним дорогим кремом.\nА чем отличается мезотерапия от биоревитализации, биореструктуризации, биоармирования. Конечно, любая женщина может запутаться в этих терминах, и что же выбрать?\nПо сути все эти термины являются разновидностью мезотерапии, отличаются друг от друга составом препаратов, разными сроками введения.\nТрадиционно в мезотерапии используются коктейли препаратов, которые подбираются индивидуально в зависимости от проблемы, но производители решили облегчить задачу косметолога и выпускают уже готовые коктейли.\nВ отличие от других инъекционных методов мезотерапия проводится 1 раз в неделю, так как препараты выводятся из кожи через 3-4 дня. Для достижения эффекта необходим курс процедур. Основное преимущество мезотерапии заключается в том, что можно решить большинство проблем, используя разные препараты.', 4500, 5, '2022-03-22 02:08:12', '2022-03-22 02:08:12'),
(12, 'Фракционное омоложение лица', 'storage/services/12.png', 'Фракционное омоложение!\nПервый лазер для дерматологии был выпущен в 1995 году Asclepion.\nВ данный MCL29  Dermablate  момент выпущено шестое поколение лазеров для дерматологии и эстетической медицины под девизом.\nОсобенность эрбиевых лазеров состоит в том, что их излучение великолепно поглощается молекулами воды в клетках. Благодаря этому удается осуществлять очень точную контролируемую абляционную шлифовку кожи, без риска ожогов и осложнений.\nЭрбиевая шлифовка лица используется одновременно и для абляции (испарения) верслоев кожи, и для стимулирования процессов регенерации в более глубоких ее слоях.', 15000, 6, '2022-03-22 02:08:12', '2022-03-22 02:08:12');

-- --------------------------------------------------------

--
-- Структура таблицы `service_contraindications`
--

CREATE TABLE `service_contraindications` (
  `contraindication_id` bigint(20) UNSIGNED NOT NULL,
  `service_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `service_contraindications`
--

INSERT INTO `service_contraindications` (`contraindication_id`, `service_id`, `created_at`, `updated_at`) VALUES
(1, 11, '2022-03-22 02:08:14', '2022-03-22 02:08:14'),
(2, 11, '2022-03-22 02:08:14', '2022-03-22 02:08:14'),
(3, 11, '2022-03-22 02:08:15', '2022-03-22 02:08:15'),
(4, 11, '2022-03-22 02:08:15', '2022-03-22 02:08:15');

-- --------------------------------------------------------

--
-- Структура таблицы `service_indications`
--

CREATE TABLE `service_indications` (
  `indication_id` bigint(20) UNSIGNED NOT NULL,
  `service_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `service_indications`
--

INSERT INTO `service_indications` (`indication_id`, `service_id`, `created_at`, `updated_at`) VALUES
(1, 11, '2022-03-22 02:08:13', '2022-03-22 02:08:13'),
(2, 11, '2022-03-22 02:08:13', '2022-03-22 02:08:13'),
(3, 11, '2022-03-22 02:08:14', '2022-03-22 02:08:14'),
(4, 11, '2022-03-22 02:08:14', '2022-03-22 02:08:14'),
(5, 11, '2022-03-22 02:08:14', '2022-03-22 02:08:14'),
(6, 11, '2022-03-22 02:08:14', '2022-03-22 02:08:14'),
(7, 11, '2022-03-22 02:08:14', '2022-03-22 02:08:14'),
(8, 11, '2022-03-22 02:08:14', '2022-03-22 02:08:14'),
(9, 11, '2022-03-22 02:08:14', '2022-03-22 02:08:14'),
(10, 11, '2022-03-22 02:08:14', '2022-03-22 02:08:14');

-- --------------------------------------------------------

--
-- Структура таблицы `service_types`
--

CREATE TABLE `service_types` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `service_types`
--

INSERT INTO `service_types` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Первичная консультация', '2022-03-22 02:08:10', '2022-03-22 02:08:10'),
(2, 'Общее очищение', '2022-03-22 02:08:10', '2022-03-22 02:08:10'),
(3, 'Уходовые программы по лицу', '2022-03-22 02:08:10', '2022-03-22 02:08:10'),
(4, 'Аппаратная косметология', '2022-03-22 02:08:10', '2022-03-22 02:08:10'),
(5, 'Инъкционная косметология', '2022-03-22 02:08:10', '2022-03-22 02:08:10'),
(6, 'Лазерная косметология', '2022-03-22 02:08:10', '2022-03-22 02:08:10'),
(7, 'Химические пилинги', '2022-03-22 02:08:11', '2022-03-22 02:08:11'),
(8, 'Инъекционные процедуры', '2022-03-22 02:08:11', '2022-03-22 02:08:11'),
(9, 'Нитиевой лифтинг', '2022-03-22 02:08:11', '2022-03-22 02:08:11'),
(10, 'Удаление новообразований', '2022-03-22 02:08:11', '2022-03-22 02:08:11'),
(11, 'Массаж тела', '2022-03-22 02:08:11', '2022-03-22 02:08:11'),
(12, 'Восковая депиляция', '2022-03-22 02:08:11', '2022-03-22 02:08:11');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `avatar` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT '/storage/user.png',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `name`, `password`, `avatar`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'root', '$2y$10$qMb7ds/eUZm.18nAa0HOhe1Jbb2iFxfv1/wNSWSpzT0el3uqZpk8m', '/storage/user.png', NULL, '2022-03-22 02:08:06', '2022-03-22 02:08:06'),
(2, 'alekseevaOlga', '$2y$10$CW5mRZm6UG.XXf.J.X38De885MXpfcIA2Dz478bxE9Dp4poMqAFpy', 'storage/users/1.jpg', NULL, '2022-03-22 02:08:09', '2022-03-22 02:08:09'),
(3, 'client', '$2y$10$fIcNwL22QdawibboUdCcW..kUw4T756rJUR0rYri5.qsbrBSygAuq', 'storage/user.png', NULL, '2022-03-22 02:08:10', '2022-03-22 02:08:10'),
(4, 'glizkoAlena', '$2y$10$yOMIhi.ZiWN88FBpgbK73.bLlo/LhGt8KQ6yZjztVRJgxCEKj56fi', 'storage/users/2.jpg', NULL, '2022-03-22 02:08:10', '2022-03-22 02:08:10');

-- --------------------------------------------------------

--
-- Структура таблицы `workers`
--

CREATE TABLE `workers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `last_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `first_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `img` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `birthday` date NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `post_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `workers`
--

INSERT INTO `workers` (`id`, `last_name`, `first_name`, `img`, `birthday`, `description`, `user_id`, `post_id`, `created_at`, `updated_at`) VALUES
(1, 'Алексеева', 'Ольга', 'storage/workers/1.jpg', '1998-02-20', 'Образование. 2003-2011 Иркутский Государственный Медицинский Университет лечебный факультет.\n2007-2008 Медицинская сестра урологического отделения Областной Онкологический диспансер.\n2009-2012 Врач консультант Фармгарант.\n2010-2011 ИГМУ ординатура по дерматовенерологии.\n2011-2012 Областной кожно-венерологический диспансер -врач дерматовенеролог.\n2012-2015 Боханская ЦРБ врач дерматовенеролог.\n2015-2016 Аптека «Фармгарант» врач-консультант.\n2016 Курсы по косметологии Иркутский университет повышения квалификации врачей.\n2016-2019 ООО «Лазермед» врач косметолог.\nс 2019 по н.в. ООО «Бьютимед», врач косметолог.', 2, 1, '2022-03-22 02:08:10', '2022-03-22 02:08:10'),
(2, 'Глызко', 'Алёна', 'storage/workers/2.jpg', '1982-04-20', 'Медицинский стаж - 29 лет, закончила Иркутский государственный медицинский институт в 1989 г по специализации \"Лечебное дело\", после института работала терапевтом в поликлинике, закончила ординатуру по дерматовенерологии в 1999 г., первичную специализацию по косметологии получила в 1999 г. в г. Москва на кафедре эстетической медицины РУДН, стаж в косметологии 19 лет. Владеет всеми инъекционными методиками, аппаратными методами, занимается коррекцией проблемной кожи. В 2017 году стала победителем регионального этапа I Всероссийского чемпионата врачей-косметологов \"Сияние Байкала\" в номинации PRO (Иркутск, Улан-Удэ, Чита), заняла II место на Всероссийском чемпионате.', 4, 2, '2022-03-22 02:08:10', '2022-03-22 02:08:10');

-- --------------------------------------------------------

--
-- Структура таблицы `worker_services`
--

CREATE TABLE `worker_services` (
  `worker_id` bigint(20) UNSIGNED NOT NULL,
  `service_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `worker_services`
--

INSERT INTO `worker_services` (`worker_id`, `service_id`, `created_at`, `updated_at`) VALUES
(1, 1, '2022-03-22 02:08:15', '2022-03-22 02:08:15'),
(1, 2, '2022-03-22 02:08:15', '2022-03-22 02:08:15'),
(1, 3, '2022-03-22 02:08:15', '2022-03-22 02:08:15'),
(1, 4, '2022-03-22 02:08:15', '2022-03-22 02:08:15'),
(1, 5, '2022-03-22 02:08:16', '2022-03-22 02:08:16'),
(1, 6, '2022-03-22 02:08:15', '2022-03-22 02:08:15'),
(1, 7, '2022-03-22 02:08:15', '2022-03-22 02:08:15'),
(1, 8, '2022-03-22 02:08:15', '2022-03-22 02:08:15'),
(1, 9, '2022-03-22 02:08:15', '2022-03-22 02:08:15'),
(1, 10, '2022-03-22 02:08:16', '2022-03-22 02:08:16'),
(1, 11, '2022-03-22 02:08:13', '2022-03-22 02:08:13'),
(1, 12, '2022-03-22 02:08:16', '2022-03-22 02:08:16');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `clients_email_unique` (`email`),
  ADD UNIQUE KEY `clients_phone_unique` (`phone`),
  ADD UNIQUE KEY `clients_user_id_unique` (`user_id`);

--
-- Индексы таблицы `contraindications`
--
ALTER TABLE `contraindications`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `contraindications_name_unique` (`name`);

--
-- Индексы таблицы `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Индексы таблицы `indications`
--
ALTER TABLE `indications`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `indications_name_unique` (`name`);

--
-- Индексы таблицы `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  ADD KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Индексы таблицы `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  ADD KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Индексы таблицы `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `orders_client_id_foreign` (`client_id`),
  ADD KEY `orders_service_id_foreign` (`service_id`),
  ADD KEY `orders_worker_id_foreign` (`worker_id`);

--
-- Индексы таблицы `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`);

--
-- Индексы таблицы `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Индексы таблицы `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `posts_name_unique` (`name`);

--
-- Индексы таблицы `records`
--
ALTER TABLE `records`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `records_phone_unique` (`phone`),
  ADD UNIQUE KEY `records_email_unique` (`email`),
  ADD KEY `records_service_id_foreign` (`service_id`);

--
-- Индексы таблицы `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`);

--
-- Индексы таблицы `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `role_has_permissions_role_id_foreign` (`role_id`);

--
-- Индексы таблицы `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `services_name_unique` (`name`),
  ADD KEY `services_service_type_id_foreign` (`service_type_id`);

--
-- Индексы таблицы `service_contraindications`
--
ALTER TABLE `service_contraindications`
  ADD KEY `service_contraindications_service_id_foreign` (`service_id`),
  ADD KEY `service_contraindications_contraindication_id_foreign` (`contraindication_id`);

--
-- Индексы таблицы `service_indications`
--
ALTER TABLE `service_indications`
  ADD KEY `service_indications_service_id_foreign` (`service_id`),
  ADD KEY `service_indications_indication_id_foreign` (`indication_id`);

--
-- Индексы таблицы `service_types`
--
ALTER TABLE `service_types`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `service_types_name_unique` (`name`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_name_unique` (`name`);

--
-- Индексы таблицы `workers`
--
ALTER TABLE `workers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `workers_user_id_unique` (`user_id`),
  ADD KEY `workers_post_id_foreign` (`post_id`);

--
-- Индексы таблицы `worker_services`
--
ALTER TABLE `worker_services`
  ADD PRIMARY KEY (`worker_id`,`service_id`),
  ADD KEY `worker_services_service_id_foreign` (`service_id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `clients`
--
ALTER TABLE `clients`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT для таблицы `contraindications`
--
ALTER TABLE `contraindications`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT для таблицы `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `indications`
--
ALTER TABLE `indications`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT для таблицы `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT для таблицы `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT для таблицы `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `posts`
--
ALTER TABLE `posts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT для таблицы `records`
--
ALTER TABLE `records`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT для таблицы `services`
--
ALTER TABLE `services`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT для таблицы `service_types`
--
ALTER TABLE `service_types`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT для таблицы `workers`
--
ALTER TABLE `workers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `clients`
--
ALTER TABLE `clients`
  ADD CONSTRAINT `clients_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE;

--
-- Ограничения внешнего ключа таблицы `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Ограничения внешнего ключа таблицы `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_client_id_foreign` FOREIGN KEY (`client_id`) REFERENCES `clients` (`id`),
  ADD CONSTRAINT `orders_service_id_foreign` FOREIGN KEY (`service_id`) REFERENCES `services` (`id`),
  ADD CONSTRAINT `orders_worker_id_foreign` FOREIGN KEY (`worker_id`) REFERENCES `workers` (`id`);

--
-- Ограничения внешнего ключа таблицы `records`
--
ALTER TABLE `records`
  ADD CONSTRAINT `records_service_id_foreign` FOREIGN KEY (`service_id`) REFERENCES `services` (`id`);

--
-- Ограничения внешнего ключа таблицы `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Ограничения внешнего ключа таблицы `services`
--
ALTER TABLE `services`
  ADD CONSTRAINT `services_service_type_id_foreign` FOREIGN KEY (`service_type_id`) REFERENCES `service_types` (`id`);

--
-- Ограничения внешнего ключа таблицы `service_contraindications`
--
ALTER TABLE `service_contraindications`
  ADD CONSTRAINT `service_contraindications_contraindication_id_foreign` FOREIGN KEY (`contraindication_id`) REFERENCES `contraindications` (`id`),
  ADD CONSTRAINT `service_contraindications_service_id_foreign` FOREIGN KEY (`service_id`) REFERENCES `services` (`id`);

--
-- Ограничения внешнего ключа таблицы `service_indications`
--
ALTER TABLE `service_indications`
  ADD CONSTRAINT `service_indications_indication_id_foreign` FOREIGN KEY (`indication_id`) REFERENCES `indications` (`id`),
  ADD CONSTRAINT `service_indications_service_id_foreign` FOREIGN KEY (`service_id`) REFERENCES `services` (`id`);

--
-- Ограничения внешнего ключа таблицы `workers`
--
ALTER TABLE `workers`
  ADD CONSTRAINT `workers_post_id_foreign` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `workers_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `worker_services`
--
ALTER TABLE `worker_services`
  ADD CONSTRAINT `worker_services_service_id_foreign` FOREIGN KEY (`service_id`) REFERENCES `services` (`id`),
  ADD CONSTRAINT `worker_services_worker_id_foreign` FOREIGN KEY (`worker_id`) REFERENCES `workers` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
