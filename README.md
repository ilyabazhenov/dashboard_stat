# Результат выполнения тестовогого задания

#### Текст задания

> Предположим, что есть система, которая собирает и агрегирует много разнородных данных. Например, это dashboard, на который выводится много показателей. Этой системе нужен некий механизм, который данные из множества сторонних источников выдает в едином формате, подходящем для графиков. Примеры источников данных: оплаченные счета, погода, курсы валют, данные о заказах из CRM и так далее.

> На вход механизму подается период времени, за который нужна информация. В ответ система получает массив данных с группировкой по датам. Например, {10.02.2015: 10, 11.02.2015: 21, ...}. Спроектируй такой механизм, который позволил бы постоянно добавлять новые источники данных, не затрагивая при этом единожды написанный код системы. Например, это может быть абстрактный класс с описанием множества методов. А для каждого источника данных делается свой наследуемый класс. 

> При этом постарайся учесть, как можно больше факторов. Например, у разных API могут быть совершенно разные способы аутентификации. Также у них разные форматы выдачи данных.

> Результат задания необходимо оформить в виде ссылки на публичный git репозиторий (github или любой другой).

#### Результат выполнения

В ходе реализации задачи были созданы следующие классы:

- [AbstractDataSource](https://github.com/ilyabazhenov/dashboard_stat/blob/master/src/IlyaBazhenov/DashboardStat/AbstractDataSource.php) - абстрактный класс некоторого источника данных
- [DataContainer](https://github.com/ilyabazhenov/dashboard_stat/blob/master/src/IlyaBazhenov/DashboardStat/DataContainer.php) - класс-контейнер для хранения записей, полученных из источника данных
- [DataItem](https://github.com/ilyabazhenov/dashboard_stat/blob/master/src/IlyaBazhenov/DashboardStat/DataItem.php) - класс, хранящий значение из источника для определенной даты
- [Exception](https://github.com/ilyabazhenov/dashboard_stat/blob/master/src/IlyaBazhenov/DashboardStat/Exception.php) - класс-исключение

В качестве примера реализации источников данных были реализованны классы для получения значений курса валют с сайта Центрального Банка РФ:

- [CBRDollarDataSource](https://github.com/ilyabazhenov/dashboard_stat/blob/master/src/IlyaBazhenov/DashboardStat/CBRDollarDataSource.php) - класс для получения данных с значениями курса доллара к рублю
- [CBREuroDataSource](https://github.com/ilyabazhenov/dashboard_stat/blob/master/src/IlyaBazhenov/DashboardStat/CBREuroDataSource.php) - класс для получения данных с значениями курса евро к рублю
- [CBRAbstractDataSource](https://github.com/ilyabazhenov/dashboard_stat/blob/master/src/IlyaBazhenov/DashboardStat/CBRAbstractDataSource.php) - абстрактный класс для получения данных с сайта Центрального Банка РФ

Для демонтрации графика изменения курса валют был создан файл [example.php](https://github.com/ilyabazhenov/dashboard_stat/blob/master/example.php), результат выполнения которого представлен в файле [index.html](https://github.com/ilyabazhenov/dashboard_stat/blob/master/index.html)


[Скриншот открытого файла index.html](https://yadi.sk/i/v01-r2o2ejEet)
