<?php
/**
 * Created by Alexander Pobereznichenko.
 * Date: 05.08.15
 * Time: 21:35
 */

namespace AP\ParserBundle\Tests\Parsers;


use AP\ParserBundle\Models\Position;
use AP\ParserBundle\Parsers\HotlineProvider;

class HotlineProviderTest extends \PHPUnit_Framework_TestCase
{

    public function testGetCatalogPagesApplePage()
    {
        $provider = new HotlineProvider();

        $content = file_get_contents(__DIR__ . '/../fixtures/apple.html');
        $actual = $provider->getCatalogPages($content, 'http://hotline.ua/mobile/mobilnye-telefony-i-smartfony/6520/');
        $expected = [
            'http://hotline.ua/mobile/mobilnye-telefony-i-smartfony/6520/',
            'http://hotline.ua/mobile/mobilnye-telefony-i-smartfony/6520/?p=1',
            'http://hotline.ua/mobile/mobilnye-telefony-i-smartfony/6520/?p=2'
        ];

        $this->assertSame($actual, $expected);
    }

    public function testGetCatalogPagesApplePageNoPager()
    {
        $provider = new HotlineProvider();

        $content = file_get_contents(__DIR__ . '/../fixtures/apple-no-pager.html');
        $actual = $provider->getCatalogPages($content, 'http://hotline.ua/mobile/mobilnye-telefony-i-smartfony/6520-92636/');
        $expected = [
            'http://hotline.ua/mobile/mobilnye-telefony-i-smartfony/6520-92636/',
        ];

        $this->assertSame($actual, $expected);
    }

    public function testGetCatalogPagePositions()
    {
        $provider = new HotlineProvider();

        $actualPositions = $provider->getCatalogPagePositions(file_get_contents(__DIR__ . '/../fixtures/apple-no-pager.html'), 'smart_phone');

        $pos1 = new Position();
        $pos1->setTitle('Apple iPhone 5C 32GB (Green)')
            ->setCategory('smart_phone')
            ->setSrc('http://hotline.ua/mobile-mobilnye-telefony-i-smartfony/apple-iphone-5c-32gb-green/');

        $pos2 = new Position();
        $pos2->setTitle('Apple iPhone 5C 16GB (Green)')
            ->setCategory('smart_phone')
            ->setSrc('http://hotline.ua/mobile-mobilnye-telefony-i-smartfony/apple-iphone-5c-16gb-green/');

        $pos3 = new Position();
        $pos3->setTitle('Apple iPhone 5C 8GB (Green)')
            ->setCategory('smart_phone')
            ->setSrc('http://hotline.ua/mobile-mobilnye-telefony-i-smartfony/apple-iphone-5c-8gb-green/');

        $this->assertCount(3, $actualPositions);
        $this->assertEquals($pos1, $actualPositions[0]);
        $this->assertEquals($pos2, $actualPositions[1]);
        $this->assertEquals($pos3, $actualPositions[2]);
    }

    public function testGetPositionData()
    {
        $provider = new HotlineProvider();
        $content = file_get_contents(__DIR__ . '/../fixtures/apple-iphone-5s-16gb-space-gray.html');

        $actualPosition = new Position();
        $actualPosition->setTitle('Apple iPhone 5S 16GB (Space Gray)')
            ->setCategory('smart_phone')
            ->setSrc('http://hotline.ua/mobile-mobilnye-telefony-i-smartfony/apple-iphone-5s-16gb-space-gray/');
        $provider->getPositionData($actualPosition, $content);


        $expectedAttributes = [
            'Тип' => 'Смартфон',
            'Тип SIM-карты' => 'Nano-SIM',
            'Стандарт' => 'GSM 850/900/1800/1900, UMTS 850/900/1700/2100/1900/2100, LTE (Bands 1, 2, 3, 4, 5, 8, 13, 17, 19, 20, 25)',
            'Высокоскоростная передача данных' => 'GPRS, EDGE, HSDPA (до 42 MБ/c), HSUPA (до 5,76 Мб/с), LTE (DL до 100 Мб/с, UL - до 50 Мб/с)',
            'Количество SIM-карт' => '1',
            'Операционная система' => 'iOS',
            'Оперативная память, ГБ' => '1',
            'Встроенная память, ГБ' => '16',
            'Слот расширения' => 'нет',
            'Габариты, мм' => '123,8x58,6x7,6',
            'Масса, г' => '112',
            'Защита от пыли и влаги' => 'нет',
            'Аккумуляторная батарея' => 'Li-Ion, 1570 мАч (несъемная)',
            'Время работы (данные производителя)' => 'разговор - до 10ч (3G), ожидание - до 250ч, интернет-браузинг - до 8/10/10ч (3G, LTE, Wi-Fi), просмотр видео - до 10ч, аудио - до 40ч',
            'Диагональ, дюймы' => '4',
            'Разрешение' => '1136x640',
            'Тип матрицы' => 'IPS',
            'PPI' => '326',
            'Датчик регулировки яркости' => 'есть',
            'Сенсорный экран (тип)' => 'сенсорный (емкостной)',
            'Другое' => 'face detection (распознавание лиц в кадре), панорамная съемка, фронтальная камера записывает видео 30 к/c',
            'Процессор' => 'Apple A7 + GPU PowerVR G6430',
            'Тип ядра' => 'Cyclone',
            'Количество ядер' => '2',
            'Частота, ГГц' => '1,3',
            'Основная камера, МП' => '8',
            'Автофокус' => 'есть',
            'Видеосъемка' => '1920х1080 точек (30 к/с), 1280х720 точек (120 к/с), стабилизация изображения, 3-х цифровой зум',
            'Вспышка' => 'двойная светодиодная',
            'Фронтальная камера, МП' => '1,2',
            'Wi-Fi' => '802.11 a/b/g/n',
            'Bluetooth' => '4.0',
            'GPS' => 'есть',
            'IrDA' => 'нет',
            'NFC' => 'нет',
            'Интерфейсный разъем' => 'USB 2.0 (Lightning)',
            'Аудиоразъем' => '3,5 мм',
            'MP3 плеер' => 'есть',
            'FM-радио' => 'нет',
            'Тип корпуса' => 'моноблок (неразборный)',
            'Материал корпуса' => 'алюминий',
            'Тип клавиатуры' => 'экранный ввод',
            'Еще' => 'сканер отпечатков пальцев, медиапроигрыватель, приемник a-GPS/GLONASS, видеотелефония, трехосевой гироскоп,  акселерометр, цифровой компас, датчик приближение, датчик освещенности, голосовой помощник Siri',
            'Производитель' => 'Apple',
            'Товар на сайте производителя' => 'www.apple.com/iphone-5s/specs/',
        ];

        $expectedPosition = new Position();
        $expectedPosition->setTitle('Apple iPhone 5S 16GB (Space Gray)')
            ->setCategory('smart_phone')
            ->setSrc('http://hotline.ua/mobile-mobilnye-telefony-i-smartfony/apple-iphone-5s-16gb-space-gray/')
            ->setAttributes($expectedAttributes);

        $this->assertEquals($expectedPosition, $actualPosition);
    }
}
