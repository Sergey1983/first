  <!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Modal Header</h4>
        </div>
        <div class="modal-body">
          
<ul class="nav flex-column">
  <li class="nav-item">
    <a class="nav-link active" href="#variables">Переменные</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="#tourists">Таблицы с туристами</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="#important">Особо важное!</a>
  </li>
</ul>



          <table id="variables" class="table table-responsive">
            
            <thead>
              
              <tr>

                <td><strong>Переменная</strong></td>
                <td><strong>Смысл</strong></td>
              
              </tr>

            </thead>

            <tbody>
              
                <tr><td>$id</td><td>Номер заявки (договора)</td></tr>
                <tr><td>$first_manager</td><td>Менеджер, оформивший заявку</td></tr>
                <tr><td>$updated</td><td>Дата последнего обновления заявки</td></tr>
                <tr><td>$buyerName</td><td>Покупатель: имя</td></tr>
                <tr><td>$buyerLastName</td><td>Покупатель: фамилия</td></tr>
                <tr><td>$buyerPatronymic</td><td>Покупатель: отчество</td></tr>
                <tr><td>$buyerPhone</td><td>Покупатель: телефон</td></tr>
                <tr><td>$buyerEmail</td><td>Покупатель: email</td></tr>
                <tr><td>$buyerBirth</td><td>Покупатель: дата рождения</td></tr>
                <tr><td>$branch_details</td><td>Реквизиты филиала</td></tr>
                <tr><td>$seria</td><td>Покупатель: серия паспорта</td></tr>
                <tr><td>$currency</td><td>Валюта тура</td></tr>
                <tr><td>$doc_number</td><td>Покупатель: номер паспорта</td></tr>
                <tr><td>$date_issued</td><td>Покупатель: дата выдачи п.</td></tr>
                <tr><td>$who_issued</td><td>Покупатель: паспорт выдан кем</td></tr>
                <tr><td>$address_pass</td><td>Покупатель: паспорт прописка</td></tr>
                <tr><td>$address_real</td><td>Покупатель: адрес фактический</td></tr>
                <tr><td>$operator_full_pay</td><td>Дата полной оплаты оператору</td></tr>
                <tr><td>$adults</td><td>Взрослые: количество</td></tr>
                <tr><td>$children</td><td>Дети: количество</td></tr>
                <tr><td>$country</td><td>Страна пребывания</td></tr>
                <tr><td>$airport</td><td>Аэропорт</td></tr>
                <tr><td>$city_from</td><td>Город вылета</td></tr>
                <tr><td>$city_return</td><td>Город возврата</td></tr>
                <tr><td>$date_depart</td><td>Дата вылета</td></tr>
                <tr><td>$date_hotel</td><td>Дата заселения в отель</td></tr>
                <tr><td>$date_return</td><td>Дата возвращения</td></tr>
                <tr><td>$nights</td><td>Ночей</td></tr>
                <tr><td>$hotel</td><td>Отель</td></tr>
                <tr><td>$room</td><td>Номер</td></tr>
                <tr><td>$food</td><td>Тип питания</td></tr>
                <tr><td>$transfer</td><td>Тип трансфера</td></tr>
                <tr><td>$visa</td><td>Виза</td></tr>
                <tr><td>$med_insurance</td><td>Медстраховка</td></tr>
                <tr><td>$noexit_insurance</td><td>Страховка от невыезда</td></tr>
                <tr><td>$sightseeing</td><td>Экскурсии</td></tr>
                <tr><td>$extra_info</td><td>Доп. информация / Маршрут</td></tr>
                <tr><td>$price_rub</td><td>Цена в рублях (для туриста)</td>
                <tr><td>$price</td><td>Цена в валюте (для туриста)</td>
                <tr><td>$operator</td><td>Туроператор</td></tr>
                <tr><td>$today</td><td>Дата: сегодня</td></tr>
                <tr><td>$tourist+name</td><td>Турист: имя</td></tr>                
                <tr><td>$tourist+lastName</td><td>Турист: фамилия</td></tr>
                <tr><td>$tourist+patronymic</td><td>Турист: отчество</td></tr>
                <tr><td>$tourist+gender</td><td>Турист: пол</td></tr>
                <tr><td>$tourist+birth_date</td><td>Турист: дата рождения</td></tr>
                <tr><td>$tourist+doc_number</td><td>Турист: номер документа</td></tr>
                <tr><td>$managerName</td><td>Менедежер: имя</td></tr>
                <tr><td>$managerLastName</td><td>Менедежер: фамилия</td></tr>
                <tr><td>$managerPatronymic</td><td>Менедежер: отчество</td></tr>
            </tbody>

          </table>

            <h3 id="tourists">Таблицы с данными туристов</h3>

                <div>
                    
                    В такой таблице каждая стока - это данные по одному туристу.
                    Создаем таблицу. Создаем в ней строку с 
                    <pre>
                    {{htmlentities('<tr id="tourists_info>
                        <td>$tourist+name</td>
                        <td>$tourist+lastName</td>
                        <td>$tourist+birth_date</td>...  и т.д.
                    </tr>')}}
                    </pre>

                    Такие строки создадутся для каждого туриста из заявки.

                </div>

           <h3 id="important">Особые замечания (важные!)</h3>

                <div>

                    Переменные '$branch_details', '$operator', '$sightseeing', '$extra_info' нельзя закрывать в тэги.
                    т.е. правильно:
                    <pre style="text-align: left">
                    {{htmlentities('
                        <p>Какой-то текст</p>
                            $branch_details
                        <p>Какой-то текст</p>')}}
                    </pre>

                    Для таблиц обязательно указывать выравнивание ('text-align')!

                    <pre><code>

                    {{htmlentities('
                        <table class="table table-bordered" 
                        style="width: 100%; text-align: center">

                            ... содержание таблицы ...

                        </table>')}}

                    </code></pre>


                    Чтобы таблица была на ширину страницы указывать style="width: 100%':

                    <pre><code>

                    {{htmlentities('
                        <table class="table table-bordered" 
                        style="width: 100%; text-align: center">

                            ... содержание таблицы ...

                        </table>')}}

                    </code></pre>

                    Разрыв страницы

                    <pre><code>

                    {{htmlentities('<pagebreak></pagebreak>')}}

                    </code></pre>



                </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>