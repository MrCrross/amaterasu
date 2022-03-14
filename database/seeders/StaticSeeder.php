<?php

namespace Database\Seeders;

use App\Models\Contraindication;
use App\Models\Indication;
use App\Models\Service;
use App\Models\ServiceContraindication;
use App\Models\ServiceIndication;
use App\Models\ServiceType;
use App\Models\WorkerService;
use Illuminate\Database\Seeder;

class StaticSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $service_types = [
            [
                'name' => 'Первичная консультация',
            ],
            [
                'name' => 'Общее очищение',
            ],
            [
                'name' => 'Уходовые программы по лицу',
            ],
            [
                'name' => 'Аппаратная косметология',
            ],
            [
                'name' => 'Инъкционная косметология',
            ],
            [
                'name' => 'Лазерная косметология',
            ],
            [
                'name' => 'Химические пилинги',
            ],
            [
                'name' => 'Инъекционные процедуры',
            ],
            [
                'name' => 'Нитиевой лифтинг',
            ],
            [
                'name' => 'Удаление новообразований',
            ],
            [
                'name' => 'Массаж тела',
            ],
            [
                'name' => 'Восковая депиляция',
            ]
        ];
        $services = [
            [
                'name' => 'Первичная консультация врача косметолога',
                'img' => 'storage/services/1.jpg',
                'price' => 1300,
                'description' => 'Первичная консультация дерматолога-косметолога обычно проходит по общей схеме: специалист выслушивает пациента, выясняет наличие аллергических реакций и список имеющихся заболеваний, спрашивает, какими косметическими средствами он пользуется. После этого проводится визуальный осмотр пациента и - при необходимости - назначаются дополнительные консультации специалистов, например, эндокринолога или проведение анализов.
После проведённых обследований и диагностики, врач-косметолог разрабатывает оптимальную для пациента схему коррекции дефекта. Она может включать подбор уходовых средств, проведение инъекционных или аппаратных процедур, курс различных массажей. Кроме того, квалификация дерматологов-косметологов позволяет при необходимости рекомендовать и назначать пациенту лекарственные средства, предназначенные для лечения проблем с кожей, обеспечивая комплексный подход в их диагностике и лечении. То есть, консультация дерматолога-косметолога необходима для профессиональной оценки возрастных или других эстетических проблем с кожей и индивидуального подбора методик по их коррекции.',
                "service_type_id" => 1
            ],
            [
                'name' => 'Комбинированная чистка лица (Космотерос)',
                'img' => 'storage/services/2.jpg',
                'price' => 1800,
                'description' => 'Для тех, кто привык к старому методу чистки, предлагаем чистку с распариванием кожи. Сюда входит демакияж, пилинг – броссаж, механическая чистка, дарсонваль, маска.',
                "service_type_id" => 2
            ],
            [
                'name' => 'Атравматичная чистка лица на Израильской косметики (Холи Лэнд)',
                'img' => 'storage/services/3.jpg',
                'price' => 2500,
                'description' => 'Процедура, цель которой очистить и сократить поры, традиционно называется чисткой кожи. Распаривание кожи с помощью горячего пара и механическое удаление содержимого пор с помощью пальцев - весьма болезненная процедура. Поэтому, используя израильскую косметику «Холи Лэнд» мы стараемся сделать чистку максимально эффективной и при этом минимально травмирующей.
Преимущество данной чистки заключается в отсутствии распаривания, для разогрева кожи и размягчения сальных пробок используются специальные лосьоны и растворы, высокий уровень антисептики,возможна локальная обработка кожи, возможность работы с сухой и чувствительной кожи.
Основные эффекты процедуры - очищение пор, выравнивание цвета и текстуры кожи, заживление воспалительных элементов, профилактика воспалений.
Этапы чистки - демакияж, фруктовый пилинг, подготовка кожи с помощью лосьонов и растворов, механическая чистка, молочный энзимный пилинг, маска - 1,5-2 часа',
                "service_type_id" => 2
            ],
            [
                'name' => 'Ультразвуковая чистка лица',
                'img' => 'storage/services/4.jpg',
                'price' => 1600,
                'description' => 'Для непроблемной кожи, склонной к сухости. Эта чистка выравнивает кожу, удаляет ороговевшие старые клетки с помощью ультразвука, но не решает проблему черных сальных пробок. Демакияж, энзимный пилинг, чистка с помощью ультразвука, маска - всё это по времени занимает 60 минут.',
                "service_type_id" => 2
            ],
            [
                'name' => 'Контурная пластика и объемное моделирование',
                'img' => 'storage/services/10.jpg',
                'price' => 21000,
                'description' => 'С возрастом наши морщины становятся глубже, носогубные морщины превращаются в складки, а объемы в верхней и средней трети лица уходят, щеки опускаются, и появляются «брыли», овал становится менее четким, лицо расширяется книзу. В результате форма лица меняется, и на лице проступает возраст. На помощь приходят филлеры-препараты стабилизированной гиалуроновой кислоты, полимолочной кислоты или с частицами кальция.
Филлер - значит заполнитель, т.е. гель вводится под морщину, выталкивая ее наружу, и в результате морщина исчезает или становится менее заметной. Но иногда коррекции морщин не хватает для эффекта омоложения, и нужно восстановить утраченные объемы, и эта процедура называется объемным или 3Д моделированием. Как правило, используются более плотные филлеры или еще их называют волюмайзеры. При правильном их введении запавшие или провисшие щеки подтягиваются и восстанавливается молодой овал.',
                "service_type_id" => 5
            ],
            [
                'name' => 'Энергия чёрной икры Клапп',
                'img' => 'storage/services/5.jpg',
                'price' => 2600,
                'description' => 'Эксклюзивный комплекс на основе икры осетровых рыб и натуральных биопептидов разглаживает мелкие морщинки, глубоко увлажняет, восстанавливает гидролипидную мантию, повышает упругость и эластичность кожи. Включает в себя очищение, пилинг ,нанесение концентрата из экстракта водорослей, ДНК икры осетровых рыб, устриц, маска, массаж.',
                "service_type_id" => 3
            ],
            [
                'name' => 'Люкс-процедура Anti-age для гурманов «Брызги шампанского»',
                'img' => 'storage/services/6.jpg',
                'price' => 5000,
                'description' => 'Рекомендуется для зрелой кожи после 35 лет Обеспечивает выраженный комплексный омолаживающий эффект, заполняет носогубные складки, ремоделирует овал лица, восстанавливает контур подбородка и скул, повышение эластичности кожи, снимает раздражение, укрепляет и уплотняет кожу. Включает в себя очищение, маску с кислородом, микрочастицами золота, гиалуроновой кислотой, концентрат сгексапептидом, экстрактом королевского винограда, пептидную маску,маску-мусс, массаж, крем',
                "service_type_id" => 3
            ],
            [
                'name' => 'Процедура для мужчин - уход за сухой кожей',
                'img' => 'storage/services/7.jpg',
                'price' => 2600,
                'description' => 'глубоко увлажняет, успокаивает и стимулирует естественный процесс регенерации, дарит свежий и ухоженный вид. Такая процедура - находка для мужчин, которые ценят себя и хотят прекрасно выглядеть. Включает в себя очищение, гель пилинг, концентрат с ДНК икры осетровых рыб, экстрактом водорослей, специальную маску, массаж по релаксирующему крему, завершающий уход.',
                "service_type_id" => 3
            ],
            [
                'name' => 'Микротоковая терапия тела',
                'img' => 'storage/services/8.jpg',
                'price' => 1600,
                'description' => 'В основе микротоковой терапии лежит импульсный электрический ток низкой частоты, всего несколько десятков микрогерц, поэтому не происходит сокращения мышц, как при электростимуляции, а воздействие идет на клеточном уровне, тем самым обеспечивая достаточно выраженный результат.
Эффективность процедуры заключается в стимуляции кровообращения, лимфодренажной функции, ускорения деления клеток и питания их энергией. Воздействие микротоков происходит на уровне кожи, сосудов и мышц.
Микротоки часто являются единственным спасением для проблемной кожи, усеянной высыпаниями,когда ни о каком другом вмешательстве не может быть и речи. Очень часто микротоки назначаются при отечности лица, как послеоперационная реабилитация после блефаропластики, при лечении целлюлита.',
                "service_type_id" => 4
            ],
            [
                'name' => 'Ультразвуковой массаж лица',
                'img' => 'storage/services/9.jpg',
                'price' => 800,
                'description' => 'Вызывает стимуляцию кожи, улучшение обменных процессов, ускорение синтеза коллагена и эластина, а также размягчение рубцов и спаечных процессов в коже при целлюлите.
Продолжительность курса - 10-15 процедур через день или ежедневно.',
                "service_type_id" => 4
            ],
            [
                'name' => 'Мезотерапия',
                'img' => 'storage/services/11.jpg',
                'price' => 4500,
                'description' => 'Это метод лечения лица и тела с помощью внутрикожных микроинъекций. Принципы мезотерапии - редко,минимальными дозами и в нужное место, т.е. только в проблемные места. Конечно иньекции - не самое приятное мероприятие в жизни, но с другой стороны,они дают потрясающие результаты,которых невозможно добиться ни одним дорогим кремом.
А чем отличается мезотерапия от биоревитализации, биореструктуризации, биоармирования. Конечно, любая женщина может запутаться в этих терминах, и что же выбрать?
По сути все эти термины являются разновидностью мезотерапии, отличаются друг от друга составом препаратов, разными сроками введения.
Традиционно в мезотерапии используются коктейли препаратов, которые подбираются индивидуально в зависимости от проблемы, но производители решили облегчить задачу косметолога и выпускают уже готовые коктейли.
В отличие от других инъекционных методов мезотерапия проводится 1 раз в неделю, так как препараты выводятся из кожи через 3-4 дня. Для достижения эффекта необходим курс процедур. Основное преимущество мезотерапии заключается в том, что можно решить большинство проблем, используя разные препараты.',
                "service_type_id" => 5
            ],
            [
                'name' => 'Фракционное омоложение лица',
                'img' => 'storage/services/12.png',
                'price' => 15000,
                'description' => 'Фракционное омоложение!
Первый лазер для дерматологии был выпущен в 1995 году Asclepion.
В данный MCL29  Dermablate  момент выпущено шестое поколение лазеров для дерматологии и эстетической медицины под девизом.
Особенность эрбиевых лазеров состоит в том, что их излучение великолепно поглощается молекулами воды в клетках. Благодаря этому удается осуществлять очень точную контролируемую абляционную шлифовку кожи, без риска ожогов и осложнений.
Эрбиевая шлифовка лица используется одновременно и для абляции (испарения) верслоев кожи, и для стимулирования процессов регенерации в более глубоких ее слоях.',
                "service_type_id" => 6
            ],
        ];

        $indications = [
            [
                'name' => 'сухая,обезвоженная кожа'
            ],
            [
                'name' => 'морщины'
            ],
            [
                'name' => 'возрастная кожа'
            ],
            [
                'name' => 'пигментация'
            ],
            [
                'name' => 'кожа «курильщика»'
            ],
            [
                'name' => 'профилактика преждевременного старения'
            ],
            [
                'name' => 'акне'
            ],
            [
                'name' => 'жирная кожа,склонная к воспалениям'
            ],
            [
                'name' => 'целлюлит'
            ],
            [
                'name' => 'коррекция жировых отложений'
            ],
        ];

        $contraindications = [
            [
                'name' => 'беременность и кормление грудью'
            ],
            [
                'name' => 'аутоиммунные заболевания'
            ],
            [
                'name' => 'гемофилия'
            ],
            [
                'name' => 'обострение герпеса'
            ],
        ];

        $serviceIndications = [
            [
                'service_id' => 11,
                'indication_id' => 1
            ],
            [
                'service_id' => 11,
                'indication_id' => 2
            ],
            [
                'service_id' => 11,
                'indication_id' => 3
            ],
            [
                'service_id' => 11,
                'indication_id' => 4
            ],
            [
                'service_id' => 11,
                'indication_id' => 5
            ],
            [
                'service_id' => 11,
                'indication_id' => 6
            ],
            [
                'service_id' => 11,
                'indication_id' => 7
            ],
            [
                'service_id' => 11,
                'indication_id' => 8
            ],
            [
                'service_id' => 11,
                'indication_id' => 9
            ],
            [
                'service_id' => 11,
                'indication_id' => 10
            ]
        ];

        $serviceContraindications = [
            [
                'service_id' => 11,
                'contraindication_id' => 1
            ],
            [
                'service_id' => 11,
                'contraindication_id' => 2
            ],
            [
                'service_id' => 11,
                'contraindication_id' => 3
            ],
            [
                'service_id' => 11,
                'contraindication_id' => 4
            ]
        ];

        $workerServices = [
            [
                'service_id' => 11,
                'worker_id' => 1
            ]
        ];

        foreach ($service_types as $service_type) {
            ServiceType::create([
                'name' => $service_type['name']
            ]);
        }

        foreach ($services as $service) {
            Service::create([
                'name' => $service['name'],
                'img' => $service['img'],
                'price' => $service['price'],
                'description' => $service['description'],
                'service_type_id' => $service['service_type_id']
            ]);
        }

        foreach ($indications as $indication) {
            Indication::create([
                'name' => $indication['name'],
            ]);
        }

        foreach ($contraindications as $contraindication) {
            Contraindication::create([
                'name' => $contraindication['name'],
            ]);
        }

        foreach ($workerServices as $workerService) {
            WorkerService::create([
                'service_id' => $workerService['service_id'],
                'worker_id' => $workerService['worker_id'],
            ]);
        }

        foreach ($serviceIndications as $serviceIndication) {
            ServiceIndication::create([
                'service_id' => $serviceIndication['service_id'],
                'indication_id' => $serviceIndication['indication_id'],
            ]);
        }

        foreach ($serviceContraindications as $serviceContraindication) {
            ServiceContraindication::create([
                'service_id' => $serviceContraindication['service_id'],
                'contraindication_id' => $serviceContraindication['contraindication_id'],
            ]);
        }
    }
}
