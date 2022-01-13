<div class="modal refill_modal payment_history" id="payment_history">
    @include('modal.menu', array('modal'=>'payment_history'))
    <div class="inout_block">
        <div class="modal_h1">
            <h1>Период отображения</h1>
        </div>
        <div class="language menu_select" id="currency_replenishment">
            <div>
                <div>
                    <input type="hidden" name="data_time" value="Месяц">
                    <span>Месяц</span>
                    <svg width="10" height="7" viewBox="0 0 10 7" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M0.366116 0.536342C0.854272 0.0751514 1.64573 0.0751514 2.13388 0.536342L5 3.24414L7.86612 0.536342C8.35427 0.0751511 9.14573 0.0751511 9.63388 0.536342C10.122 0.997532 10.122 1.74527 9.63388 2.20646L5.88388 5.74932C5.39573 6.21051 4.60427 6.21051 4.11612 5.74932L0.366116 2.20646C-0.122039 1.74527 -0.122039 0.997533 0.366116 0.536342Z" fill="#686D87"></path>
                    </svg>
                </div>
            </div>
            <ul>
                <li data-value="RUB"><span>RUB</span></li>
                <li data-value="USD"><span>USD</span></li>
                <li data-value="EUR"><span>EUR</span></li>
                <li data-value="KZT"><span>KZT</span></li>
            </ul>
        </div>
        <div class="item_refill_wrapper">
            <table class="item_refill_wrapper_table">
                <thead>
                    <tr>
                        <th>Дата</th>
                        <th>Метод оплаты</th>
                        <th>Сумма</th>
                        <th>Статус</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>12.08.21 23:22</td>
                        <td><img src="/temple/imgs/refill/refill_1.png" alt=""><span>Lb8ZQBeK4CwUWRHpdRzxr5nK1CZT3PbJGy</span></td>
                        <td>-7 000 000,00 ₽</td>
                        <td>Выполнено</td>
                    </tr>
                    <tr class="activ">
                        <td>12.08.21 23:22</td>
                        <td><img src="/temple/imgs/refill/refill_1.png" alt=""><span>Lb8ZQBeK4CwUWRHpdRzxr5nK1CZT3PbJGy</span></td>
                        <td>+7 000 000,00 ₽</td>
                        <td>Выполнено</td>
                    </tr>
                    <tr>
                        <td>12.08.21 23:22</td>
                        <td><img src="/temple/imgs/refill/refill_1.png" alt=""><span>Lb8ZQBeK4CwUWRHpdRzxr5nK1CZT3PbJGy</span></td>
                        <td>-7 ₽</td>
                        <td>Отменено</td>
                    </tr>
                    <tr>
                        <td>12.08.21 23:22</td>
                        <td><img src="/temple/imgs/refill/refill_1.png" alt=""><span>Lb8ZQBeK4CwUWRHpdRzxr5nK1CZT3PbJGy</span></td>
                        <td>-7 000 000,00 ₽</td>
                        <td>Выполнено</td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="payment_history_show_all">
            <span>Показать больше</span>
            <svg width="10" height="6" viewBox="0 0 10 6" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M4.99997 5.70028C4.82075 5.70028 4.64155 5.63185 4.50491 5.49528L0.205141 1.19546C-0.0683804 0.921938 -0.0683804 0.47847 0.205141 0.205058C0.478552 -0.0683528 0.921932 -0.0683528 1.19548 0.205058L4.99997 4.00978L8.80449 0.205191C9.07801 -0.0682199 9.52134 -0.0682199 9.79473 0.205191C10.0684 0.478602 10.0684 0.922071 9.79473 1.19559L5.49503 5.49541C5.35832 5.63201 5.17912 5.70028 4.99997 5.70028Z" fill="white" />
            </svg>
        </div>
    </div>
</div>