# Transport
Формат передачі GPS-даних Gorelektrotransservice-Kharkiv
Дані передаются файлами з назвами trol.json та tram.json відповідно. 
Кодування: UTF-8. 
Період оновлення даних: 15 с.  
Формат даних: JSON 
{"version": "1.1", 
"timestamp": <Час формування пакету. Формат: POSIX>, 
"positions": [{
	"type": <Тип транспорту: (доступні значення: trol, tram ): string>,
"number": <Номер маршруту: string>, 
"name": <Назва маршруту: string>, 
"length": <Довжина маршруту: float >, 
"bort_number": <Бортовий номер: int>, 
"handicapped": <Машина з низькою підлогою, пристосована для людей з обмеженими можливостями: boolean (true | false)>, 
"gps_id": <Ідентифікатор машини: int64>, 
"lng": <Довгота (розділювач – крапка): float>, 
"lat": <Широта (розділювач – крапка): float>, 
"speed": <Моментальна швидкість (км/год): int>, 
"timestamp": <Час отримання координат GPS-приймачем. Формат: POSIX>, 
"bearing": <Орієнтація у просторі (кут у градусах відносно півночі за годинниковою стрілкою. Діапазон значень: 0 – 360): int>, 
"odometr": <Розрахункова відстань, яку пройшов транспортний засіб з моменту попередньої реєстрації трекера (км): int>
"difference": <Расстояние в километрах между переданными координатами и полученного списка трекеров: float>
},…
]} 
