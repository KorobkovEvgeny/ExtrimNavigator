<?php

use yii\db\Migration;

class m161009_023140_create_faick_data extends Migration
{
    public function up()
    {
        $this->batchInsert('{{%cities}}', ['id', 'city', 'name_city'], [
            [1, 'moskva', 'Москва'],
            [2, 'novgorod', 'Новгород'],
            [3, 'vladivostok', 'Владивосток'],
        ]);

        $this->batchInsert('{{%categories}}', ['id', 'name', 'name_category', 'created_at', 'updated_at'], [
            [1, 'neobychnye-i-ekstrim-mesta', 'Необычные и экстрим места', 1476707050, 1476707050],
            [2, 'ekstremalnye-puteshestviya', 'Экстремальные путешествия', 1476707050, 1476707050],
            [3, 'akvabayk', 'Аквабайк', 1476707050, 1476707050],
            [4, 'alpinizm', 'Альпинизм', 1476707050, 1476707050],
            [5, 'veykbording', 'Вейкбординг', 1476707050, 1476707050],
            [6, 'vindserfing', 'Виндсерфинг', 1476707050, 1476707050],
            [7, 'vodnye-lyzhi', 'Водные лыжи', 1476707050, 1476707050],
            [8, 'dayving', 'Дайвинг', 1476707050, 1476707050],
            [9, 'deltaplanerizm', 'Дельтапланеризм', 1476707050, 1476707050],
            [10, 'kaytserfing', 'Кайтсерфинг', 1476707050, 1476707050],
            [11, 'kayaking', 'Каякинг', 1476707050, 1476707050],
            [12, 'lyzhnyy-sport-i-katanie', 'Лыжный спорт и катание', 1476707050, 1476707050],
            [13, 'mauntinbayking', 'Маунтинбайкинг', 1476707050, 1476707050],
            [14, 'parashyutizm', 'Парашютизм', 1476707050, 1476707050],
            [15, 'rafting', 'Рафтинг', 1476707050, 1476707050],
            [16, 'serfing', 'Серфинг', 1476707050, 1476707050],
            [17, 'skayserfing', 'Скайсерфинг', 1476707050, 1476707050],
            [18, 'skalolazanie', 'Скалолазание', 1476707050, 1476707050],
            [19, 'snoubord', 'Сноуборд', 1476707050, 1476707050],
            [20, 'spelestologiya', 'Спелестология', 1476707050, 1476707050],
            [21, 'yahting', 'Яхтинг', 1476707050, 1476707050],
        ]);

        $this->insert('{{%users}}', [
            'id' => 1,
            'userlogin' => 'admin',
            'password_hash' => '$2y$13$ACZf8PhBaj9UWc.ktcsea.idsjMJtqHW1fL2h4sAZpY4KfeYaCUgm',
            'email' => '1@mail.ru',
            'created_at' => 1475985201,
            'updated_at' => 1475985201,
        ]);

        $this->batchInsert('{{%places}}', ['id', 'name', 'description', 'author_id', 'category_id', 'city_id', 'coordinates', 'rating', 'created_at', 'updated_at'], [
            [1, 'Lorem ipsum dolor sit amet', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit...', 1, 1, 1, '43.125, 132.145', 5, 1475985201, 1475985201],
            [2, 'Lorem ipsum dolor sit amet', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit...', 1, 1, 3, '43.125, 132.145', 5, 1475985201, 1475985201],
            [3, 'Lorem ipsum dolor sit amet', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit...', 1, 1, 2, '43.125, 132.145', 5, 1475985201, 1475985201],
            [4, 'Lorem ipsum dolor sit amet', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit...', 1, 2, 1, '43.125, 132.145', 5, 1475985201, 1475985201],
            [5, 'Lorem ipsum dolor sit amet', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit...', 1, 2, 2, '43.125, 132.145', 5, 1475985201, 1475985201],
            [6, 'Lorem ipsum dolor sit amet', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit...', 1, 2, 1, '43.125, 132.145', 5, 1475985201, 1475985201],
            [7, 'Lorem ipsum dolor sit amet', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit...', 1, 2, 2, '43.125, 132.145', 5, 1475985201, 1475985201],
            [8, 'Lorem ipsum dolor sit amet', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit...', 1, 5, 1, '43.125, 132.145', 5, 1475985201, 1475985201],
            [9, 'Lorem ipsum dolor sit amet', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit...', 1, 6, 3, '43.125, 132.145', 5, 1475985201, 1475985201],
            [10, 'Lorem ipsum dolor sit amet', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit...', 1, 12, 1, '43.125, 132.145', 5, 1475985201, 1475985201],
        ]);

        $this->batchInsert('{{%comments}}', ['id', 'place_id', 'comment', 'author_id', 'created_at', 'updated_at'], [
            [1, 1, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit.', 1, 1475985201, 1475985201],
            [2, 1, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit.', 1, 1475985201, 1475985201],
            [3, 3, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit.', 1, 1475985201, 1475985201],
            [4, 2, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit.', 1, 1475985201, 1475985201],
            [5, 3, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit.', 1, 1475985201, 1475985201],
            [6, 1, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit.', 1, 1475985201, 1475985201],
        ]);
    }

    public function down()
    {

    }

    /*
    // Use safeUp/safeDown to run migration code within a transaction
    public function safeUp()
    {
    }

    public function safeDown()
    {
    }
    */
}
