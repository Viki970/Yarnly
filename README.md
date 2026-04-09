# Yarnly

**Yarnly** е пълноценна социална платформа за любителите на ръчна изработка с прежда — мястото, където ентусиастите на плетене на една кука, на две куки и бродерия откриват шаблони, споделят завършени проекти, следват вдъхновяващи творци и изграждат своето занаятчийско портфолио. Създадена като дипломен проект с използване на **Laravel 12** с Livewire + Alpine.js за потребителския интерфейс.

---

## Съдържание

- [Общ преглед](#общ-преглед)
- [Страници на приложението и потребителски сценарии](#страници-на-приложението-и-потребителски-сценарии)
- [Функционалности в детайли](#функционалности-в-детайли)
  - [Библиотека със шаблони](#библиотека-със-шаблони)
  - [Общностна галерия](#общностна-галерия)
  - [Колекции от публикации (албуми)](#колекции-от-публикации-албуми)
  - [Колекции от шаблони](#колекции-от-шаблони)
  - [Потребителски профили](#потребителски-профили)
  - [Система за следване](#система-за-следване)
  - [Личен табло](#личен-табло)
  - [Известия](#известия)
  - [Контрол на поверителността](#контрол-на-поверителността)
  - [Външен вид и тематика](#външен-вид-и-тематика)
  - [Интернационализация](#интернационализация)
  - [Админ панел](#админ-панел)
- [Технологичен стек](#технологичен-стек)
- [Архитектура и дизайнерски решения](#архитектура-и-дизайнерски-решения)
- [Структура на проекта](#структура-на-проекта)
- [Карта на маршрутите](#карта-на-маршрутите)
- [Схема на базата данни](#схема-на-базата-данни)
- [Eloquent модели и връзки](#eloquent-модели-и-връзки)
- [Автентикация и сигурност](#автентикация-и-сигурност)
- [Роли и разрешения](#роли-и-разрешения)
- [Услуги](#услуги)
- [Инсталация](#инсталация)
- [Променливи на средата](#променливи-на-средата)
- [Стартиране на приложението](#стартиране-на-приложението)
- [Изпълнение на тестове](#изпълнение-на-тестове)
- [Лиценз](#лиценз)

---

## Общ преглед

Yarnly решава реален проблем за общността на тъканните изкуства: преди Yarnly занаятчиите трябваше да се разпръскват между Pinterest (шаблони), Instagram (споделяне на проекти) и електронни таблици (организиране на колекции). Yarnly обединява всичко това в едно цялостно, управлявано от общността пространство.

**Основни стълбове:**

| Стълб | Какво означава за потребителя |
|---|---|
| Откриване | Разглеждане на курирана, търсима библиотека с шаблони за плетене на една кука, две куки и бродерия с PDF изтегляния |
| Създаване | Качване на собствени шаблони (PDF + изображение на корицата) и споделянето им с общността |
| Споделяне | Публикуване на снимки на завършени проекти, получаване на харесвания и коментари, изграждане на публично портфолио |
| Свързване | Следване на творци, които ви вдъхновяват, виждане само на техните публикации в личния ви поток |
| Организиране | Курирайте запазените си шаблони в именувани колекции, групирани по тип занаят |
| Персонализиране | Избор на цветова схема, размер на шрифта, език и външен вид на профила |

---

## Страници на приложението и потребителски сценарии

### Сценарий на гост (неавтентикиран)

1. Попада на **началната страница** (`/`) — анимирано hero секция, статистики на платформата (общо шаблони / потребители / публикации), представяне на функционалности, обяснение как работи и лента за търсене на творци в реално време.
2. Посещава една от трите страници на **библиотеката със шаблони** (`/patterns/crochet`, `//patterns/knitting`, `/patterns/embroidery`) — разглежда най-новите шаблони, филтрира по подкатегория, преглежда детайлите на шаблон и го чете в PDF прегледа в браузъра.
3. Посещава **галерията** (`/models/gallery`) — вижда всички публикации на общността, може да търси; ако кликне върху **Следвани** или се опита да хареса/коментира, се появява модален прозорец за вход/регистрация вместо пренасочване.
4. Кликва върху **Вход** или **Създаване на акаунт** — отива към `/login` или `/register`.

### Сценарий на автентикиран потребител

1. След вход → **Табло** (`/dashboard`) — личен преглед на дейността.
2. **Създаване на шаблон** → `/patterns/create` — попълване на формуляр, качване на PDF и изображение.
3. **Създаване на публикация** → `/gallery/posts/create` — качване на до 10 снимки на проект.
4. **Преглед на техния профил** → `/profile` — виждане на всички техни публикации, запазено/харесано съдържание, качени шаблони и създадени колекции.
5. **Посещение на профила на друг потребител** → `/users/{username}` — следване/прекратяване на следване, преглед на публичното им съдържание според техните настройки за поверителност.
6. **Настройки** → `/settings` — управление на парола, имейл, 2FA, предпочитания за известия, поверителност, външен вид и език.
7. **Известия** → `/notifications` — преглед на цялата активност, кликване върху всяко известие, за да отидете към съответния ресурс.

---

## Функционалности в детайли

### Библиотека със шаблони

Библиотеката със шаблони е разделена на три основни страници за занаяти, всяка със собствен URL, изглед и система от категории. `PatternController` обслужва шест публични крайни точки — една листваща и една филтрирана по категория за всеки тип занаят.

**Таксономия на подкатегориите:**

| Занаят | Подкатегории |
|---|---|
| Плетене на една кука | Одеяла и покривки, Амигуруми, Чанти и торби, Облекло, Декорация за дома |
| Плетене на две куки | Облекло, Аксесоари, Дом и декор, Играчки, Бебешки артикули |
| Бродерия | Бродерия на дрехи, Обръчна изкуство и стенна декорация, Кръстат бод, Ръчни техники |

**Какво показва всяка страница за занаят:**
- Брояч „Ново тази седмица" (шаблони, публикувани в текущата календарна седмица).
- Брояч „Вашата опашка" (запазените шаблони на автентикирания потребител за този тип занаят).
- Решетка „Най-нови" (до 30 най-скорошни шаблона).
- Хоризонтална лента за филтриране по категория — кликването върху категория пререндира страницата с филтрирани резултати чрез параметър `GET`.
- Секция „Общностни колекции", показваща публични колекции за този тип занаят.

**Детайли и изтегляне на шаблон:**
- `GET /patterns/{id}/view` — рендира PDF-а във `<iframe>` вътре в layout-а на приложението (не се разкрива директен линк към суров файл).
- `GET /patterns/{id}/download` — стрийва файла чрез `response()->download()`, използвайки `original_filename`, така че потребителят да получи четимо име на файл.
- PDF-ите се съхраняват в `storage/app/public/patterns/pdfs/`, а корицата на изображенията в `storage/app/public/patterns/images/`.

**Създаване на шаблон** (`POST /patterns`):
-Validация на сървъра: PDF трябва да е `application/pdf`, максимум 10 MB; изображението трябва да е PNG/JPG, максимум 5 MB.
- MIME типът се проверява двойно с `getMimeType()` след първоначалната проверка на разширението.
- Тагове се санитизират: изрязват се празни символи, премахват се дубликати, премахва се началната `#`, максимум 50 знака всеки, общо максимум 500 знака.
- След съхранението всички последователи на автора получават `NewPatternFromFollowedNotification`.
- Налага се лимит от 25 активни шаблона на потребител преди формата изобщо да се покаже.

**Цветове на значките за трудност:**

| Трудност | Цвят на значката |
|---|---|
| Начинаещи | Зелен |
| Средно ниво | Кехлибар/жълт |
| Напреднали | Червен |

---

### Общностна галерия

Галерията (`/models/gallery`) е основният социален фийд на платформата.

**Табове:**
- **Последно добавени** — всички публикации, подредени по `created_at` в низходящ ред.
- **Най-високо оценени** — подредени по брой лайкове в низходящ ред.
- **Последвани** — само публикации от потребители, които автентикираният потребител следва. Гостите, които кликнат върху този таб, виждат модал за вход.

**Търсене:** Лайв AJAX лента за търсене (`/search/users`) търси потребители по име или `@потребителско_име`, връщайки JSON с профилна снимка, цвят на аватара, инициали и връзка към профила им. Резултатите зачитат настройката за поверителност `searchable_profile`.

**Търсене на публикации:** Лентата за търсене в галерията приема и свободен текст и филтрира видимите резултати от страна на клиента по таг, описание и потребителско име на създателя с помощта на Alpine.js.

**Лайкване на публикация:**
- `POST /posts/{id}/like` / `DELETE /posts/{id}/like` — превключва се в галерията и страницата с подробности за публикацията.
- Текущият потребител трябва да е автентикиран. Авторът получава `NewLikeNotification` (според неговите предпочитания за известия).

**Запазване/отбелязване на публикация:**
- `POST /posts/{id}/favorite` / `DELETE /posts/{id}/favorite`.
- Запазените публикации се появяват в таба „Запазени“ на профила на потребителя и могат да се организират в **Колекции от публикации**.

**Коментари:**
- На страницата с подробности за публикацията (`/gallery/posts/{id}`), коментарите се зареждат чрез `GET /posts/{id}/comments`, връщайки JSON.
- Нови коментари се изпращат чрез `POST /posts/{id}/comments`; валидация `required|string|max:500`.
- Авторът получава `NewCommentNotification`.
- JSON отговорът на коментара включва: `body`, име на `author`, `initials`, URL на `avatar`, `avatar_color` и четима `created_at` (напр. „преди 2 часа“).

**Създаване на публикация** (`POST /gallery/posts`):
- Качете 1–10 изображения (JPEG/PNG/WebP, максимум 5 MB всяко). Всяко изображение се съхранява в `storage/app/public/posts/` и се свързва към публикацията чрез `post_images` с колона `order`, запазваща поредицата на качване.
- `tags` се съхраняват като низ с разделител запетая и се парсват в масив чрез `$post->tags_array` (премахва началната `#`, филтрира празни записи).
- След създаването всички последователи получават `NewPostFromFollowedNotification`.

**Изтриване на публикация:** `DELETE /gallery/posts/{id}` — само собственикът на публикацията може да я изтрие; изтрива и всички свързани `PostImage` записи и техните файлове от съхранението.

---

### Колекции от публикации (Албуми)

Потребителите могат да организират своите **запазени** публикации в именувани албуми за отбелязване, наречени Колекции от публикации.

- Създавайте, преименувайте и изтривайте колекции от публикации от таба „Запазени“ на профила.
- Добавяйте/премахнете запазена публикация към/от колекция чрез поповър пикър, показан на всяка карта на публикация.
- Колекциите от публикации са пер потребител и винаги са лични (те са лични групи за отбелязване, не се споделят с други).
- Показват се на страницата на профила под отделен подтаб „Колекции“ в таба „Запазени“.

---

### Колекции със шаблони

Колекциите със шаблони са **споделени тематични набори** от шаблони, които потребител създава от собствените си качени шаблони.

**Поток за създаване (в две стъпки):**

1. **Стъпка 1 — Избор на шаблони** (`/collections/select-patterns`): Потребителят вижда решетка от собствените си шаблони с кутийки за отметка. Избира един или повече и кликва „Продължи към подробностите за колекцията“. Може да добавя и към съществуваща колекция на тази стъпка.
2. **Стъпка 2 — Подробности за колекцията** (`/collections/create`): Попълнете име (задължително, максимум 255 знака), описание (опционално, максимум 1000 знака), тип занаят, видимост (публична/лична) и опционално изображение за корица (JPEG/PNG/GIF, максимум 5 MB).

**Колекции на страниците за шаблони:**
- Всяка страница за занаят показва решетка „Общностни набори“ с до 30 публични колекции за този тип занаят, с аватара, името на създателя и броя шаблони.

**Страница с подробности за колекцията** (`/collections/{id}`):
- Показва всички шаблони в колекцията с техните значки за трудност, брояч „запазили го творци“ и индивидуални връзки за изтегляне.
- Бутон „Изтегли всички шаблони“ стрийва изтегляне в стил zip на всички PDF-и (или свързва всеки поотделно).
- Контролите за редакция и изтриване се показват само на собственика на колекцията.

**Отбелязване на колекции:**
- Всеки автентикиран потребител може да отбеляза публична колекция на друг потребител чрез `POST /collections/{id}/favorite`.
- Отбелязаните колекции се появяват в таба „Запазени“ на профила на потребителя.
- След създаването на нова публична колекция всички последователи на автора получават `NewCollectionFromFollowedNotification`.

---

### Потребителски профили

#### Моят профил (`/profile`)

Собственият профил на автентикирания потребител, рендиран от `ProfileController@show`, със следните табове:

| Таб | Съдържание |
|---|---|
| Публикации | Всички публикации, които потребителят е споделил, подредени по най-нови първи |
| Запазени | Запазени/отбелязани публикации, опционално организирани в колекции от публикации |
| Харесани | Публикации, които потребителят е харесал |
| Шаблони | Всички шаблони, които потребителят е качил |
| Колекции | Колекции със шаблони, които потребителят е създал |

Допълнителни подсекции "запазени", видими на страницата на профила:
- Любими шаблони (шаблони, запазени в pivot таблицата `user_favorites`)
- Любими колекции (колекции, запазени в pivot таблицата `collection_favorites`)

**Данни в хедъра на профила:**
- Профилна снимка (качено изображение или автоматично генериран аватар с инициали с избрания `avatar_color`).
- Показвано име и `@потребителско_име`.
- Кратка биография (максимум 200 знака, показва се само когато е зададена).
- Брой публикации, брой последователи, брой последвани.

#### Редакция на профил (`/profile/edit`)

Полета за редакция:
- **Профилна снимка** — съхранява се в `storage/app/public/profile_pictures/`, максимум 5 MB, jpg/jpeg/png/gif/webp.
- **Пълно име** (`name`, задължително, максимум 255 знака).
- **Биография** (`bio`, опционално, максимум 200 знака) — лайв брояч на знаците с Alpine.js във формата.
- **Имейл** — промяната на имейла задейства повторна верификация.
- **Цвят на аватара** — hex цветово поле с 6 предварително зададени мостри (виолетово, индиго, розово, изумрудено, кехлибарено, небесно) и свободен hex picker. По подразбиране `#7c3aed` (виолетово), когато не е зададен.

#### Публичен потребителски профил (`/users/{user}`)

Рендиран от отделен изглед (различен от Моят профил) и контролиран от настройките за поверителност на собственика:

- Бутон За последване/Спиране на последването с лайв актуализация на броя последователи чрез JSON отговор.
- Действието на последване изпраща `NewFollowNotification` към последвания потребител.
- Самопоследването е защитено: връща 422 JSON грешка, ако потребителят опита да последва себе си.
- Табовете, видими за посетителите, зависят от предпочитанията за поверителност на собственика (`show_liked_posts`, `show_saved_posts` и т.н.).

---

### Система за социално последване

Реализирана с pivot таблица `follows` (`follower_id`, `following_id`) и два метода в модела `User`:

- `$user->follow(User $target)` — вмъква запис, задейства известие.
- `$user->unfollow(User $target)` — изтрива записа.
- `$user->isFollowing(User $target)` — булева проверка.
- `$user->followers()` — `BelongsToMany` чрез `follows.following_id`.
- `$user->following()` — `BelongsToMany` чрез `follows.follower_id`.

Заявките за последване/спиране на последването отговарят с JSON (`{ following: bool, followers_count: int }`), когато заявката очаква JSON, което позволява на бутона в профила да се актуализира без презареждане на страницата, използвайки Alpine.js.

---

### Личен табло за управление

Маршрутът `/dashboard` (auth + verified) изчислява и предава на изгледа:

| Променлива | Описание |
|---|---|
| `patternsCount` | Общ брой шаблони, качени от потребителя |
| `postsCount` | Общ брой публикации, споделени от потребителя |
| `followersCount` | Общ брой последователи |
| `followingCount` | Общ брой последвани потребители |
| `likesReceived` | Общо лайкове на всички публикации на потребителя |
| `commentsReceived` | Общо коментари на всички публикации на потребителя |
| `commentsGiven` | Коментари, оставени от потребителя на публикации на други |
| `patternsSaved` | Сумата от пъти, когато публикациите на потребителя са били запазени + пъти неговите шаблони са били отбелязани |
| `patternsThisMonth` | Шаблони, качени през текущия календарен месец |
| `postsThisMonth` | Публикации, споделени през текущия календарен месец |
| `likesThisWeek` | Лайкове на публикациите на потребителя от началото на текущата седмица |
| `commentsThisWeek` | Коментари на публикациите на потребителя от началото на текущата седмица |
| `followersThisWeek` | Нови последователи, придобити от началото на текущата седмица |
| `recentPatterns` | 5-те най-скоро качени шаблона |
| `recentPosts` | 4-те най-скоро споделени публикации (с изображения eager-loaded) |

---

### Известия

#### Съхранение

Известията използват вградения в Laravel **канал за известия в база данни**. Всяко известие се съхранява като ред в таблицата `notifications` с:
- `id` — UUID низ.
- `type` — пълно PHP име на класа.
- `notifiable_type` / `notifiable_id` — полиморфна връзка към `App\Models\User`.
- `data` — JSON блок съдържащ текста на съобщението и `url` за пренасочване.
- `read_at` — null докато не бъде маркирано като прочетено.

#### Доставка

Всички шест класа за известия имплементират `via()` връщащ `['database']`. Всеки изгражда `toDatabase()` данни:

```php
// Example: NewLikeNotification
return [
    'message' => ":name liked your post.",
    'url'     => route('gallery.posts.show', $this->post->id),
    'actor'   => $this->actor->name,
];
```

#### Камбанка и брой непрочетени

Иконата с камбанка в навигационната лента извиква `Auth::user()->unreadNotifications->count()` за да покаже значка. Посещаването на `/notifications` автоматично маркира всички непрочетени известия като прочетени чрез `$user->unreadNotifications->markAsRead()`.

Кликването върху отделно известие на `/notifications/{id}/mark-read` го маркира като прочетено и пренасочва към `data.url`.

#### Контрол чрез предпочитания

Преди да изпрати известие, всеки клас за известия проверява:

```php
app(NotificationPreferenceService::class)->check($notifiable, 'notify_likes')
```

Ако предпочитанието е изключено, `via()` връща празен масив и известието се пропуска незабележимо. Предпочитанията се съхраняват като JSON в `storage/app/notification_prefs/{userId}.json` като всички ключове по подразбиране са `true`.

---

### Контроли за поверителност

Предпочитанията за поверителност се съхраняват за всеки потребител като JSON в `storage/app/privacy_prefs/{userId}.json` и се управляват от `PrivacyPreferenceService`.

| Ключ | По подразбиране | Когато е `false` |
|---|---|---|
| `searchable_profile` | `true` | Потребителят е изключен от JSON резултатите на `/search/users` |
| `show_liked_posts` | `true` | Раздел "Харесани" е скрит в публичния профил на потребителя |
| `show_saved_posts` | `true` | Раздел "Запазени" е скрит в публичния профил на потребителя |
| `show_saved_patterns` | `true` | Секцията с любими шаблони е скрита в публичния профил |
| `show_saved_collections` | `true` | Секцията с любими колекции е скрита в публичния профил |

И двете услуги (`NotificationPreferenceService` и `PrivacyPreferenceService`) следват един и същи модел:
- `get(object $user): array` — чете JSON файл, слива с подразбиранията така че липсващите ключове винаги връщат стойност.
- `save(int $userId, array $prefs): void` — валидира само познатите ключове, преобразува в bool, записва JSON.
- `check(object $user, string $key): bool` — удобна обвивка за един ключ.

---

### Външен вид и тематизиране

Всички настройки за външен вид са съхранени в таблицата `users` (`theme_preference`) и се прилагат на всяка страница чрез Blade layout, който чете `Auth::user()->theme_preference`.

| Настройка | Опции | Как работи |
|---|---|---|
| Цветов режим | Тъмен / Светъл / Системен | Добавя/премахва класа `dark` на `<html>` |
| Акцентен цвят | Виолетов, Индиго, Розов, Изумруден, Кехлибарен, Небесен | Задава CSS custom property `--accent-*` |
| Размер на шрифта | Малък, Среден, Голям | Задава атрибут `data-font-size` на `<html>` |

Седемте акцентни цвята съответстват на цветовите палитри на Tailwind CSS 4 и са префиксирани в стиловата таблица, така че акцентът може да се променя без повторно компилиране. Промените влизат в сила незабавно след запазване на формата за настройки на външния вид.

---

### Интернационализация

Yarnly поддържа **Английски** (по подразбиране) и **Български** като използва Laravel's `__()` helper.

**Как работи:**
1. `SetLocale` middleware се изпълнява при всяка заявка. Ако `Auth::guest()`, езикът се задава на `en`. За автентикирани потребители, чете `locale` бисквитката.
2. Бисквитката се записва от страницата за езикови настройки (`/settings/language`) и важи за сесията на браузъра.
3. `App::setLocale($locale)` се извиква само за одобрени езици (`['en', 'bg']`) за да се предотврати инжектиране.
4. Всички български низове са в `lang/bg.json` — един плосък JSON файл с ~400 ключа покриващи всеки UI низ включително навигация, форми, съобщения за грешки, текст на известия, админ панел и страници със шаблони.
5. Плурализацията използва експлицитни Blade тернарни оператори (напр. `$count === 1 ? __('post') : __('posts')`) защото Laravel's `Str::plural()` не обработва славянски езици правилно.

---

### Админ панел

Админ маршрутите са под `middleware(['auth', 'verified'])` с допълнителна inline проверка `role === 'admin'`.

#### Табло — `/admin/dashboard`

Всички статистики се изчисляват в маршрутното closure и се предават на `adminPanel.dashboard`:

- **Потребители**: общо, нови този месец, нови днес, общ брой администратори.
- **Шаблони**: общо, нови този месец, разбивка по вид занаят (`crochet` / `knitting` / `embroidery`) като `pluck('total', 'category')` карта.
- **Публикации**: общо, нови този месец, разбивка по вид занаят.
- **Колекции**: общо, нови този месец.
- **Ангажираност**: общо харесвания, общо коментари в платформата.
- **Таблица с последни потребители**: 10-те най-скоро присъединили се потребители с техния брой шаблони.
- **Таблица с последни шаблони**: 15-те най-скоро качени шаблони с автор и дата на качване.

#### Управление на потребители — `/admin/users`

Напълно претърсваем, сортируем, филтрируем, пагиниран интерфейс за управление на потребители:

- **Търсене**: `name LIKE %q%` ИЛИ `username LIKE %q%` (без значение от главни букви).
- **Филтър по роля**: падащо меню за всички / потребител / админ.
- **Опции за сортиране**: най-нови (по подразбиране), най-стари, име А–Я, най-много шаблони (чрез `withCount`), най-много публикации (чрез `withCount`).
- **Пагинация**: 20 потребители на страница, общият брой е показан в заглавието.
- **Действия за потребител**:
  - **Повиши / Отнеми админ** — `PATCH /admin/users/{user}/toggle-role` превключва колоната `role` между `user` и `admin`. Не може да се насочи към текущо влезлия администратор.
  - **Изтрий** — `DELETE /admin/users/{user}` премахва акаунта и всички свързани данни. Не може да се насочи към текущо влезлия администратор.

---

## Технологичен стек

| Слой | Технология | Версия | Бележки |
|---|---|---|---|
| Език | PHP | 8.2+ | Строги типове навсякъде |
| Framework | Laravel | 12 | |
| Оторизация | Laravel Fortify | ^1.30 | 2FA, потвърждение на email, нулиране на парола |
| UI компоненти | Livewire Flux | ^2.1 | Предварително изградени достъпни компоненти |
| Реактивни PHP изгледи | Livewire Volt | ^1.7 | Едно-файлови Volt компоненти |
| JS реактивност | Alpine.js | ^3.4 | Използва се за превключватели, брояци, модали |
| CSS framework | Tailwind CSS | ^4.0 | CSS-first конфигурация, няма tailwind.config.js |
| Build инструмент | Vite | ^7.0 | `laravel-vite-plugin` интеграция |
| База данни | MySQL / MariaDB | 8+ / 10.4+ | |
| Файлово съхранение | Laravel local disk | — | `storage/app/public` symlink към `public/storage` |
| Опашка | Database | — | `QUEUE_CONNECTION=database` |
| Тестване | Pest | ^4.1 | `pest-plugin-laravel` за Laravel helpers |
| Стил на кода | Laravel Pint | ^1.18 | Базиран на PSR-12 |
| Dev инструменти | Laravel Pail | ^1.2 | Наблюдение на логове в терминал |
| Dev инструменти | Laravel Sail | ^1.41 | Опционална Docker среда |

---

## Архитектура и дизайнерски решения

**Без JavaScript framework.** Целият frontend е сървърно рендиран Blade + Livewire компоненти. Alpine.js управлява малки реактивни части (брояци на символи, модали, превключване на табове, падащи менюта) без каквато и да е компилация по време на build освен CSS обработката на Vite.

**Контролер-за-концепция.** Всеки основен домейн има собствен контролер (`PatternController`, `PostController`, `CollectionController`, `ProfileController`, `FollowController`, `NotificationController`, `SearchController`). Маршрутна логика, която е уникална и кратка, живее inline в `web.php` (dashboard, admin dashboard, админ действия за потребители) за да се избегне създаването на контролери с един метод.

**Service обекти за пресичащи се предпочитания.** `NotificationPreferenceService` и `PrivacyPreferenceService` се инжектират където и да е необходимо да се четат или записват предпочитания, запазвайки логиката DRY в контролерите и класовете за известия. Те използват плоски JSON файлове вместо допълнителни колони в базата данни, за да се избегне мигриране на таблицата `users` при всеки нов ключ за предпочитание.

**Без API слой.** Приложението не е SPA. JSON отговори съществуват само за специфични AJAX взаимодействия: търсене на потребители, коментари към публикации, превключване на харесвания/проследявания. Всички зареждания на страници са пълни сървърно рендирани отговори.

**Известия като записи в базата данни.** Използването на вградения в Laravel `database` канал означава, че известията могат да се запитват, пагинират и групират по `read_at` без каквато и да е WebSocket инфраструктура. Доставката в реално време е извън обхвата на v1.

**Миграциите са append-only.** Промените в схемата се правят в отделни migration файлове, така че историята на миграциите да се запази и `php artisan migrate:fresh` винаги да произвежда валидна база данни.

---

## Структура на проекта

```
yarnly/
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── Auth/                       # Fortify auth override controllers
│   │   │   ├── CollectionController.php    # Pattern collection CRUD + favouriting
│   │   │   ├── FollowController.php        # follow / unfollow actions
│   │   │   ├── NotificationController.php  # index + mark-read
│   │   │   ├── PatternController.php       # list by craft/category + view/download/create
│   │   │   ├── PostController.php          # gallery CRUD + like/save/comment
│   │   │   ├── PostCollectionController.php# post bookmark albums
│   │   │   ├── ProfileController.php       # my profile + edit + user profile
│   │   │   └── SearchController.php        # /search/users JSON endpoint
│   │   ├── Middleware/
│   │   │   └── SetLocale.php               # cookie-based locale switching
│   │   └── Requests/
│   │       ├── ProfileUpdateRequest.php    # name, bio, email validation
│   │       └── StorePostRequest.php        # post create validation
│   ├── Models/
│   │   ├── User.php                        # central model; all relationships defined here
│   │   ├── Pattern.php                     # CATEGORIES const, difficulty/category helpers
│   │   ├── Post.php                        # tags_array accessor, isLikedBy/isFavoritedBy
│   │   ├── PostImage.php
│   │   ├── PostLike.php
│   │   ├── PostComment.php
│   │   ├── PostFavorite.php
│   │   ├── PostCollection.php              # bookmark album (saved-post groups)
│   │   └── Collection.php                 # pattern collection; getCraftTypeColor/Label helpers
│   ├── Notifications/
│   │   ├── NewFollowNotification.php
│   │   ├── NewLikeNotification.php
│   │   ├── NewCommentNotification.php
│   │   ├── NewPostFromFollowedNotification.php
│   │   ├── NewPatternFromFollowedNotification.php
│   │   ├── NewCollectionFromFollowedNotification.php
│   │   └── NotificationBell.php           # Volt component for nav bar bell
│   ├── Providers/
│   │   ├── AppServiceProvider.php
│   │   ├── FortifyServiceProvider.php     # registers custom Fortify views
│   │   └── VoltServiceProvider.php
│   └── Services/
│       ├── NotificationPreferenceService.php
│       └── PrivacyPreferenceService.php
├── bootstrap/
│   ├── app.php                            # middleware registration
│   └── providers.php
├── config/
│   ├── app.php
│   ├── auth.php
│   ├── fortify.php                        # Fortify feature flags
│   └── ...
├── database/
│   ├── migrations/                        # 19 sequential migration files
│   ├── factories/
│   │   └── UserFactory.php
│   └── seeders/
├── lang/
│   ├── bg.json                            # ~400 Bulgarian translation strings
│   └── bg/                               # validation.php, auth.php BG overrides
├── public/
│   ├── index.php
│   ├── storage -> ../storage/app/public   # symlink created by storage:link
│   └── build/                             # Vite compiled assets
├── resources/
│   ├── css/
│   │   └── app.css                        # Tailwind 4 directives + custom properties
│   ├── js/
│   │   └── app.js                         # Alpine.js bootstrap
│   └── views/
│       ├── adminPanel/
│       │   ├── dashboard.blade.php
│       │   └── users.blade.php
│       ├── auth/                           # login, register, 2FA, password reset (4 views)
│       ├── collections/
│       │   ├── create.blade.php
│       │   ├── select-patterns.blade.php
│       │   └── show.blade.php
│       ├── dashboard.blade.php
│       ├── gallery/
│       │   ├── gallery.blade.php           # main gallery with 3 tabs
│       │   └── posts/
│       │       ├── create.blade.php
│       │       └── show.blade.php
│       ├── homepage/
│       │   └── home.blade.php
│       ├── layouts/
│       │   ├── app.blade.php               # authenticated layout
│       │   └── guest.blade.php             # unauthenticated layout
│       ├── notifications/
│       │   └── index.blade.php
│       ├── partials/
│       │   └── auth-modal.blade.php        # guest login/register slide-over
│       ├── patterns/
│       │   ├── create.blade.php
│       │   ├── crochet/
│       │   │   ├── crochet_patterns.blade.php
│       │   │   └── pattern_viewer.blade.php
│       │   ├── knitting/
│       │   │   └── knitting_patterns.blade.php
│       │   └── embroidery/
│       │       └── embroidery_patterns.blade.php
│       ├── profile/
│       │   ├── my-collections.blade.php
│       │   ├── myprofile/
│       │   │   ├── show.blade.php          # tabbed own profile page
│       │   │   └── edit.blade.php          # profile edit form
│       │   └── user/
│       │       └── show.blade.php          # public user profile
│       └── settings/                       # password, email, privacy, appearance, language
├── routes/
│   ├── web.php                             # all application routes
│   └── auth.php                            # Fortify auth routes
├── storage/
│   ├── app/
│   │   ├── public/                         # user-uploaded files
│   │   ├── notification_prefs/             # per-user JSON preference files
│   │   └── privacy_prefs/                  # per-user JSON preference files
│   └── logs/
└── tests/
    ├── Pest.php
    ├── TestCase.php
    ├── Feature/
    └── Unit/
```

---

## Карта на маршрутите

| Метод | URI | Controller / Closure | Изисква оторизация |
|---|---|---|---|
| GET | `/` | Closure (homepage) | Не |
| GET | `/search/users` | `SearchController@users` | Не |
| GET | `/patterns/crochet` | `PatternController@crochet` | Не |
| GET | `/patterns/crochet/{category}` | `PatternController@crochetByCategory` | Не |
| GET | `/patterns/knitting` | `PatternController@knitting` | Не |
| GET | `/patterns/knitting/{category}` | `PatternController@knittingByCategory` | Не |
| GET | `/patterns/embroidery` | `PatternController@embroidery` | Не |
| GET | `/patterns/embroidery/{category}` | `PatternController@embroideryByCategory` | Не |
| GET | `/models/gallery` | `PatternController@gallery` | Не |
| GET | `/patterns/{pattern}/view` | `PatternController@view` | Не |
| GET | `/patterns/{pattern}/download` | `PatternController@download` | Не |
| GET | `/dashboard` | Closure | auth + verified |
| GET | `/admin/dashboard` | Closure | auth + verified |
| GET | `/admin/users` | Closure | auth + verified |
| PATCH | `/admin/users/{user}/toggle-role` | Closure | auth + verified |
| DELETE | `/admin/users/{user}` | Closure | auth + verified |
| GET | `/profile` | `ProfileController@show` | auth + verified |
| GET | `/profile/edit` | `ProfileController@edit` | auth + verified |
| PATCH | `/profile` | `ProfileController@update` | auth + verified |
| DELETE | `/profile` | `ProfileController@destroy` | auth + verified |
| GET | `/users/{user}` | `ProfileController@showUser` | Не |
| GET | `/gallery/posts/create` | `PostController@create` | auth + verified |
| POST | `/gallery/posts` | `PostController@store` | auth + verified |
| GET | `/gallery/posts/{post}` | `PostController@show` | Не |
| DELETE | `/gallery/posts/{post}` | `PostController@destroy` | auth + verified |
| GET | `/posts/{post}/comments` | `PostController@comments` | Не |
| POST | `/posts/{post}/comments` | `PostController@storeComment` | auth + verified |
| POST | `/posts/{post}/like` | `PostController@like` | auth + verified |
| DELETE | `/posts/{post}/like` | `PostController@unlike` | auth + verified |
| POST | `/posts/{post}/favorite` | `PostController@addFavorite` | auth + verified |
| DELETE | `/posts/{post}/favorite` | `PostController@removeFavorite` | auth + verified |
| POST | `/users/{user}/follow` | `FollowController@follow` | auth + verified |
| DELETE | `/users/{user}/follow` | `FollowController@unfollow` | auth + verified |
| GET | `/patterns/create` | `PatternController@create` | auth + verified |
| POST | `/patterns` | `PatternController@store` | auth + verified |
| GET | `/collections/select-patterns` | `CollectionController@selectPatterns` | auth + verified |
| GET | `/collections/create` | `CollectionController@create` | auth + verified |
| POST | `/collections` | `CollectionController@store` | auth + verified |
| GET | `/my-collections` | `CollectionController@myCollections` | auth + verified |
| GET | `/notifications` | `NotificationController@index` | auth + verified |
| GET | `/notifications/{id}/mark-read` | `NotificationController@markRead` | auth + verified |
| GET | `/settings` | Closure / Volt | auth + verified |

---

## Схема на базата данни

### `users`

| Колона | Тип | Nullable | По подразбиране | Бележки |
|---|---|---|---|---|
| `id` | bigint unsigned PK | Не | auto | |
| `name` | varchar(255) | Не | — | Пълно показвано име |
| `bio` | varchar(200) | Да | null | Кратка биография, макс 200 символа |
| `username` | varchar(255) | Да | null | Уникално, използва се в URL на профила |
| `email` | varchar(255) | Не | — | Уникален |
| `email_verified_at` | timestamp | Да | null | Задава се след клик на email |
| `role` | enum('admin','user') | Не | `user` | |
| `password` | varchar(255) | Не | — | bcrypt хеширана |
| `profile_picture` | varchar(255) | Да | null | Относителен път в public storage |
| `avatar_color` | varchar(7) | Да | null | Hex цвят, напр. `#7c3aed` |
| `theme_preference` | varchar(255) | Да | `dark` | `dark`, `light`, или `system` |
| `two_factor_secret` | text | Да | null | Криптирана TOTP тайна |
| `two_factor_recovery_codes` | text | Да | null | Криптиран масив от кодове за възстановяване |
| `two_factor_confirmed_at` | timestamp | Да | null | Кога 2FA беше активирана |
| `remember_token` | varchar(100) | Да | null | |
| `created_at` / `updated_at` | timestamp | Да | null | |

### `patterns`

| Колона | Тип | Nullable | Бележки |
|---|---|---|---|
| `id` | bigint PK | Не | |
| `user_id` | FK → users | Не | Cascade delete |
| `title` | varchar(255) | Не | |
| `description` | text | Да | |
| `craft_type` | varchar(255) | Не | `crochet`, `knitting`, `embroidery` |
| `category` | varchar(255) | Не | Подкатегория slug |
| `difficulty` | varchar(255) | Не | `beginner`, `intermediate`, `advanced` |
| `estimated_hours` | int | Да | мин 1, макс 200 |
| `tags` | varchar(500) | Да | Разделени със запетая, чисти (без `#`) |
| `pdf_file` | varchar(255) | Не | `patterns/pdfs/{uuid}.pdf` |
| `original_filename` | varchar(255) | Не | Показва се на потребителя при изтегляне |
| `image_path` | varchar(255) | Да | `patterns/images/{uuid}.jpg` |
| `makers_saved` | int | Не | По подразбиране 0 |

### `posts`

| Колона | Тип | Nullable | Бележки |
|---|---|---|---|
| `id` | bigint PK | Не | |
| `user_id` | FK → users | Не | |
| `description` | text | Да | |
| `craft_type` | varchar(255) | Не | |
| `tags` | varchar(255) | Да | Разделени със запетая |

### `post_images`

| Колона | Тип | Бележки |
|---|---|---|
| `id` | bigint PK | |
| `post_id` | FK → posts | Cascade delete |
| `image_path` | varchar(255) | `posts/{uuid}.jpg` |
| `order` | int | 0-индексиран, запазва последователност на качване |

### `follows`

| Колона | Тип | Бележки |
|---|---|---|
| `id` | bigint PK | |
| `follower_id` | FK → users | Потребителят който следва |
| `following_id` | FK → users | Следваният потребител |
| `created_at` | timestamp | |

### `post_likes`

| Колона | Тип | Бележки |
|---|---|---|
| `id` | bigint PK | |
| `user_id` | FK → users | |
| `post_id` | FK → posts | |
| `created_at` | timestamp | |

### `post_favorites`

| Колона | Тип | Бележки |
|---|---|---|
| `id` | bigint PK | |
| `user_id` | FK → users | |
| `post_id` | FK → posts | |
| `created_at` | timestamp | |

### `post_comments`

| Колона | Тип | Бележки |
|---|---|---|
| `id` | bigint PK | |
| `user_id` | FK → users | |
| `post_id` | FK → posts | |
| `body` | text | макс 500 символа |
| `created_at` / `updated_at` | timestamp | |

### `user_favorites`

| Колона | Тип | Бележки |
|---|---|---|
| `id` | bigint PK | |
| `user_id` | FK → users | |
| `pattern_id` | FK → patterns | |
| `created_at` / `updated_at` | timestamp | |

### `collections`

| Колона | Тип | Бележки |
|---|---|---|
| `id` | bigint PK | |
| `user_id` | FK → users | |
| `name` | varchar(255) | |
| `description` | text | nullable |
| `craft_type` | varchar(255) | crochet / knitting / embroidery |
| `cover_image_path` | varchar(255) | nullable |
| `is_public` | tinyint(1) | 0 = частна, 1 = публична |
| `created_at` / `updated_at` | timestamp | |

### `collection_pattern`

Pivot таблица свързваща `collections` към `patterns` (many-to-many с timestamps).

### `collection_favorites`

| Колона | Тип | Бележки |
|---|---|---|
| `id` | bigint PK | |
| `user_id` | FK → users | |
| `collection_id` | FK → collections | |
| `created_at` / `updated_at` | timestamp | |

### `post_collections`

| Колона | Тип | Бележки |
|---|---|---|
| `id` | bigint PK | |
| `user_id` | FK → users | Собственик на албума |
| `name` | varchar(255) | Име на албума |
| `created_at` / `updated_at` | timestamp | |

### `post_collection_post`

Pivot таблица свързваща `post_collections` към `posts` (запазени публикации организирани в албуми).

### `notifications`

Стандартна Laravel полиморфна таблица за известия. Ключови колони:

| Колона | Тип | Бележки |
|---|---|---|
| `id` | char(36) UUID PK | |
| `type` | varchar(255) | FQCN на класа за известие |
| `notifiable_type` | varchar(255) | Винаги `App\Models\User` |
| `notifiable_id` | bigint | User ID |
| `data` | text | JSON: `{message, url, actor}` |
| `read_at` | timestamp | null = непрочетено |

---

## Eloquent модели и връзки

### `User`

```
patterns()              → HasMany(Pattern)
favoritePatterns()      → BelongsToMany(Pattern, user_favorites)
posts()                 → HasMany(Post)
likedPosts()            → BelongsToMany(Post, post_likes)
favoritedPosts()        → BelongsToMany(Post, post_favorites)
postComments()          → HasMany(PostComment)
collections()           → HasMany(Collection)
favoriteCollections()   → BelongsToMany(Collection, collection_favorites)
postCollections()       → HasMany(PostCollection)
followers()             → BelongsToMany(User, follows, following_id, follower_id)
following()             → BelongsToMany(User, follows, follower_id, following_id)
notifications()         → MorphMany (Laravel вградено)
```

**Изчислени помощници:** `initials()`, `avatarColor()`, `hasProfileImage()`, `getIsAdminAttribute()`, `hasFavorited()`, `hasFavoritedCollection()`, `hasLikedPost()`, `hasFavoritedPost()`, `isFollowing()`.

### `Pattern`

```
user()                  → BelongsTo(User)
```

**Константи:** `Pattern::CATEGORIES` — вложен масив дефиниращ валидни видове занаяти и техните подкатегории slug-ове и етикети.

**Помощници:** `getCategoryLabel()`, `getDifficultyColor()`.

### `Post`

```
user()                  → BelongsTo(User)
images()                → HasMany(PostImage, ordered by `order`)
likes()                 → HasMany(PostLike)
favorites()             → HasMany(PostFavorite)
comments()              → HasMany(PostComment, ordered oldest first)
```

**Accessors:** `getLikesCountAttribute()`, `getCommentsCountAttribute()`, `getTagsArrayAttribute()` (премахва `#`, изрязва интервали, филтрира празни).

**Помощници:** `isLikedBy(User)`, `isFavoritedBy(User)`.

### `Collection`

```
user()                  → BelongsTo(User)
patterns()              → BelongsToMany(Pattern, collection_pattern)
```

**Помощници:** `getCraftTypeLabel()`, `getCraftTypeColor()` (връща Tailwind име на цвят за рендиране на badge), `hasPattern(Pattern)`.

---

## Оторизация и сигурност

Оторизацията се обработва от **Laravel Fortify** конфигуриран в `config/fortify.php` и `FortifyServiceProvider`.

### Активирани функционалности

| Функционалност | Описание |
|---|---|
| Регистрация | Име, потребителско име, email, парола; авто-влизане след регистрация |
| Потвърждение на email | Подписан URL изпратен по email при регистрация; защитените маршрути използват `verified` middleware |
| Влизане | Стандартен email + парола; ограничен по скорост от Fortify |
| Запомни ме | Постоянна бисквитка за влизане |
| Нулиране на парола | Подписан email линк, токени съхранени в `password_reset_tokens` |
| Актуализации на паролата | Налични от Settings; изискват потвърждение на текущата парола |
| Актуализации на профила | Промени на име, биография, email чрез `ProfileUpdateRequest` |
| Двуфакторна оторизация | TOTP (Google Authenticator, Authy, и др.); QR код + ръчен ключ + 8 кода за възстановяване |
| Потвърждение на парола | Чувствителните действия изискват скорошно потвърждение на парола (15-минутен прозорец) |

### Сигурност при качване на файлове

- Всички качвания се валидират за MIME тип от страна на сървъра (само разширението не е доверено).
- PDF-ите се проверяват двойно с `$file->getMimeType() === 'application/pdf'`.
- Качените файлове се съхраняват със случайни UUID като имена на файлове в `storage/app/public/` — никога директно в директорията `public/`.
- `original_filename` се съхранява отделно за четими от хора изтегляния.
- Обслужването на PDF използва `response()->download()` през контролер, не директен URL, така че достъпът може да се контролира в бъдеще.

### CSRF

Всички форми включват `@csrf`. Vite's axios конфигурацията включва автоматично `X-CSRF-TOKEN` header за AJAX заявки.

### SQL injection

Всички заявки към базата данни използват Eloquent ORM или query builder с параметърно свързване. Няма raw SQL с потребителски вход.

### XSS

Всички Blade променливи се изписват с `{{ }}` (двойни скоби), което HTML-кодира по подразбиране. Raw изход `{!! !!}` не се използва за данни доставени от потребители.

---

## Роли и права

| Роля | Възможности |
|---|---|
| `user` | Управление на собствени шаблони, публикации, колекции, профил; проследяване/спиране на проследяване; харесване/коментиране/запазване |
| `admin` | Всички възможности на потребител + достъп до `/admin/dashboard` и `/admin/users`; повишаване/понижаване на други потребители; изтриване на всеки акаунт |

**Защити:**
- Администратор не може да понижи себе си (проверката `$user->id === Auth::id()` връща 403).
- Администратор не може да изтрие себе си (същата проверка).
- Админ маршрутите не са защитени от специален middleware gate; те използват inline `abort_if($user->role !== 'admin', 403)` или еквивалент.

---

## Услуги

### `NotificationPreferenceService`

Път: `app/Services/NotificationPreferenceService.php`

Управлява предпочитания за известия opt-in/opt-out за всеки потребител, съхранени като JSON.

```php
// Стойности по подразбиране (всички opt-in)
const DEFAULTS = [
    'notify_followers'       => true,
    'notify_likes'           => true,
    'notify_comments'        => true,
    'notify_new_posts'       => true,
    'notify_new_patterns'    => true,
    'notify_new_collections' => true,
];

get(object $notifiable): array    // слива съхранените с подразбиранията
save(int $userId, array $prefs): void
check(object $notifiable, string $key): bool
```

### `PrivacyPreferenceService`

Път: `app/Services/PrivacyPreferenceService.php`

Управлява предпочитания за видимост на профила за всеки потребител, съхранени като JSON.

```php
const DEFAULTS = [
    'searchable_profile'     => true,
    'show_liked_posts'       => true,
    'show_saved_posts'       => true,
    'show_saved_patterns'    => true,
    'show_saved_collections' => true,
];

get(object $user): array
save(int $userId, array $prefs): void
check(object $user, string $key): bool
```

И двете услуги се резолват чрез `app(ServiceClass::class)` (автоматично constructor injection) където и да са необходими.

---

## Инсталиране

### Предварителни изисквания

- **PHP 8.2+** с разширения: `pdo_mysql`, `mbstring`, `openssl`, `fileinfo`, `gd` (или `imagick`)
- **[Composer](https://getcomposer.org)** 2.x
- **[Node.js](https://nodejs.org)** 18+ и **npm** 9+
- **MySQL 8+** или **MariaDB 10.4+**

### Стъпки

**1. Клонирайте хранилището**

```bash
git clone https://github.com/your-username/yarnly.git
cd yarnly
```

**2. Инсталирайте PHP зависимости**

```bash
composer install
```

**3. Инсталирайте Node зависимости**

```bash
npm install
```

**4. Копирайте environment файла**

```bash
cp .env.example .env
```

**5. Генерирайте application ключ**

```bash
php artisan key:generate
```

**6. Създайте базата данни**

Създайте MySQL база данни наречена `yarnly` (или каквото конфигурирате в `.env`):

```sql
CREATE DATABASE yarnly CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
```

**7. Конфигурирайте средата**

Редактирайте `.env` с вашите database credentials и mail настройки (вижте [Environment променливи](#environment-променливи)).

**8. Стартирайте database миграциите**

```bash
php artisan migrate
```

**9. Създайте public storage symlink**

```bash
php artisan storage:link
```

Това създава symlink `public/storage` → `storage/app/public` така че качените файлове да са достъпни от уеб.

**10. Компилирайте frontend assets**

```bash
npm run build
```

**11. (Опционално) Заредете базата данни със seed данни**

```bash
php artisan db:seed
```

---

## Environment променливи

Пълна `.env` справка с обяснения:

```dotenv
# ─── Application ───────────────────────────────────────────────────────────────
APP_NAME=Yarnly
APP_ENV=local                       # local | staging | production
APP_KEY=                            # Автоматично генериран от php artisan key:generate
APP_DEBUG=true                      # Задайте на false в production
APP_URL=http://localhost:8000       # Трябва да съответства на вашия реален URL (за подписани URL-и и emails)
APP_LOCALE=en
APP_FALLBACK_LOCALE=en
APP_FAKER_LOCALE=en_US

# ─── Database ──────────────────────────────────────────────────────────────────
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=yarnly
DB_USERNAME=root
DB_PASSWORD=

# ─── Cache, Sessions & Queues ──────────────────────────────────────────────────
CACHE_STORE=file                    # file | redis | database
SESSION_DRIVER=database             # database | file | cookie | redis
SESSION_LIFETIME=120                # Минути
QUEUE_CONNECTION=database           # Необходима за изпращане на известия

# ─── Mail ──────────────────────────────────────────────────────────────────────
# Необходимо за: потвърждение на email, нулиране на парола, 2FA setup emails
MAIL_MAILER=smtp
MAIL_HOST=smtp.mailtrap.io          # Заменете с вашия доставчик
MAIL_PORT=2525
MAIL_USERNAME=
MAIL_PASSWORD=
MAIL_ENCRYPTION=null                # tls | ssl | null
MAIL_FROM_ADDRESS="noreply@yarnly.com"
MAIL_FROM_NAME="Yarnly"

# ─── File Storage ──────────────────────────────────────────────────────────────
FILESYSTEM_DISK=local               # local е добре за разработка; използвайте s3 за production
```

**Mail доставчици за разработка:**
- [Mailtrap](https://mailtrap.io) — прихваща emails в sandbox inbox (налична безплатна версия)
- [Mailgun](https://www.mailgun.com) — реална доставка, щедра безплатна версия
- [Resend](https://resend.com) — модерен developer-first email API

**За production**, допълнително задайте:
```dotenv
APP_ENV=production
APP_DEBUG=false
SESSION_DRIVER=database
CACHE_STORE=redis           # Препоръчително за production
QUEUE_CONNECTION=redis      # Препоръчително за production
```

---

## Стартиране на приложението

### Разработка — всички услуги наведнъж

Персонализираният `composer dev` скрипт стартира всички необходими процеси едновременно използвайки `concurrently`:

```bash
composer dev
```

Това стартира едновременно:
- `php artisan serve` — Laravel development сървър на `http://localhost:8000`
- `php artisan queue:listen --tries=1` — обработва jobs за известия
- `php artisan pail --timeout=0` — наблюдава application логове в терминала
- `npm run dev` — Vite HMR dev сървър за CSS/JS hot reload

Алтернативно, използвайки npm директно:

```bash
npm run dev-all
```

### Стартиране на услугите поотделно

```bash
# Laravel сървър
php artisan serve

# Vite dev сървър (CSS + JS hot reload)
npm run dev

# Queue worker (необходим за известия)
php artisan queue:listen --tries=1

# Log наблюдател
php artisan pail
```

### Production build и deployment

```bash
# 1. Инсталирайте само production зависимости
composer install --no-dev --optimize-autoloader

# 2. Компилирайте минифицирани assets
npm run build

# 3. Кеширайте конфигурацията
php artisan config:cache
php artisan route:cache
php artisan event:cache
php artisan view:cache

# 4. Стартирайте чакащите миграции
php artisan migrate --force

# 5. Уверете се, че storage symlink съществува
php artisan storage:link

# 6. Стартирайте queue worker като daemon (използвайте Supervisor в production)
php artisan queue:work --tries=3 --timeout=60
```

---

## Стартиране на тестове

Yarnly използва **Pest** testing framework.

```bash
# Стартирайте всички тестове
php artisan test

# Или чрез Composer
composer test

# Стартирайте с покритие (изисква Xdebug или PCOV)
php artisan test --coverage

# Стартирайте само feature тестове
php artisan test --testsuite=Feature

# Стартирайте само unit тестове
php artisan test --testsuite=Unit
```

Преди всяко стартиране на тест, `composer test` изчиства config cache (`php artisan config:clear`) за да осигури чиста среда.

---

## Лиценз

Този проект е с отворен код под [MIT лиценз](https://opensource.org/licenses/MIT).
