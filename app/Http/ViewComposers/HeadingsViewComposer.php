<?php

namespace App\Http\ViewComposers;

use Illuminate\View\View;


class HeadingsViewComposer
{
    /**
     * The user repository implementation.
     *
     * @var UserRepository
     */



    /**
     * Create a new profile composer.
     *
     * @param  UserRepository  $users
     * @return void
     */
    public function __construct()
    {
        // Dependencies automatically resolved by service container...

        

    }

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)

    {



        $data = [

            'headings' => 

            [

                'home' => 'Заявки', 
                'tour.create' => 'Создать ',
                'tour.show' => 'Просмотр заявки',
                'tour.edit' => 'Редактировать',
                'tour.versions' => 'История изменений заявки',

                'booking.edit' => 'Бронирование',
                'payment_tourist.create' => 'Оплаты туриста по заявке',
                'payment_operator.create' => 'Оплаты оператору по заявке',


                'contract.choose' => 'Печать договора (допсоглашения)',
                'contract.show' => 'Предварительный просмотр -',
                'contract.versions' => 'История документов по заявке',

                'admin.start' => 'Панель админа',

                'user.index' => 'Список менеджеров',
                'user.create' => 'Создать менеджера',
                'user.edit' => 'Редактировать менеджера',
                'user.destroy-warning' => 'А нельзя удалить-то!:)',

                'admin.templates.start' => 'Список шаблонов документов',
                'template.index' => 'Шаблоны:', 
                'template.edit' => 'Редактировать шаблон:',
                'template.show' => 'Просмотр шаблона',

                'airports.index' => 'Список аэропортов',
                'airports.create' => 'Создать аэропорт',
                'airports.edit' => 'Редактировать аэропорт',

                'operators.index' => 'Список операторов',
                'operators.create' => 'Создать оператора',
                'operators.edit' => 'Редактировать оператора',

                'branches.index' => 'Список филиалов',
                'branches.create' => 'Создать филиал',
                'branches.edit' => 'Редактировать филиал',   

                'tourist_payments.index' => 'Оплаты туристов',
                'accounting.index' => 'Бухгалтерия',
                'statistics.index' => 'Ложь, наглая ложь и... статистика!',
                'statistics.for_one' => 'Детализация статистики',

                'pay_methods.index' => 'Список методов оплаты',
                'pay_methods.create' => 'Создать метод оплаты',
                'pay_methods.edit' => 'Редактировать метод оплаты',

            ]
        
        ];


        $view->with($data);
    }
}