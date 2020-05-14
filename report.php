<?php 

try{
	header('Content-type: application/pdf');

	$values = array();
	//parse_str($_POST['formData'], $values);

	// данные пациента
	$InputId = $values['InputId'];
	$InputSurname = $values['InputSurname'];
	$InputFirstName = $values['InputFirstName'];
	$InputSecondName = $values['InputSecondName'];
	$InputBirth = $values['InputBirth'];
	$InputHeight = $values['InputHeight'];
	$InputWeight = $values['InputWeight'];
	$InputSex = $values['InputSex'];
	$InputRase = $values['InputRase'];
	$InputDate = $values['InputDate'];
	$InputNameDoctor = $values['InputNameDoctor'];


	//подключаем библиотеку
	include('library/tcpdf.php'); 

	//создаем объект 
	$pdf = new TCPDF('P', 'mm', 'A4', true, 'UTF-8');
		
	//шрифты
	//$pdf->SetFont('Helvetica', '', 19);
	$pdf->SetFont('dejavusans', '', 14, '', true); // безопасный
		
	//отключаем хедер и футер 
	$pdf->setPrintHeader(false);
	$pdf->setPrintFooter(false);

	//обрыв страницы
	$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

	//страница 1 
	$pdf->AddPage('P', 'A4');
			
	//вертикальная позиция для колонки
	$y = $pdf->getY();
	
	//цвет для левой колонки
	$pdf->SetFillColor(75, 120, 114);

	$left_column = '';

	//левая колонка
	$pdf->writeHTMLCell(40, '295', '1', '1', $left_column, 0, 0, 1, true, 'J', true);

	//цвет для текста 
	//$pdf->SetTextColor();

	//главный заголовок
	$title = '
	<div><h1>&nbsp;&nbsp;PharmacoGenomeX<sub>2</sub></h1></div>
	<style>
	h1 {
		color: #FFFFFF;
		font-size: 24px;
	}
	</style>
	';

	//блоки справа 
	$pdf->WriteHTMLCell(170, 48, '88', '0', "", 1,0); //блок 1
	$pdf->WriteHTMLCell(120, 33, '101', '1', "$title", 0,0, 'J', true); //блок 2

	//текст интро
	$text_intro = '<h4>Результаты генотипирования<br> и рекомендации<br> по персонализированной терапии</h4>
	<style>
	h4 {
		color: #4B7872;
		text-align: right;
		font-size: 14px;
	}
	</style>
	';

	//вывод контента
	$pdf->WriteHTMLCell(120, 30, '80', '55', "$text_intro", 0,0);

	//картинка
	$pdf->Image('web_medium.png', 45, 75, 180, 120, 'PNG', '', '', true, 150, '', false, false, 1, false, false, false);

	//таблица данных пациента
	$table1 = <<<EOD
	<table>
	<tr>
	<td><strong>Фамилия</strong></td>
	<td>$InputSurname</td>
	<td><strong>ID</strong></td>
	<td>$InputId</td>
	</tr>
	<tr>
	<td>Имя</td>
	<td>$InputFirstName</td>
	<td>Дата рождения</td>
	<td>$InputBirth</td>
	</tr>
	<tr>
	<td>Отчество</td>
	<td>$InputSecondName</td>
	<td>Пол</td>
	<td>$InputSex</td>
	</tr>
	<tr>
	<td>Вес</td>
	<td>$InputWeight</td>
	<td>Раса</td>
	<td>$InputRase</td>
	</tr>
	<tr>
	<td>Рост</td>
	<td>$InputHeight</td>
	<td>Дата</td>
	<td>$InputDate</td>
	</tr>
	</table>

	<style>
	table {
		font-size: 11px;
	}
	</style>
	EOD;

	//вывод данных
	$pdf->WriteHTMLCell(140, 24, '43', '210', "$table1", 1,0);

	//электронная подпись 
	$sign = '<p><strong>Электронная подпись</strong></p>
	<p>Застрожин Михаил Сергеевич, к.м.н.,<br>руководитель лаборатории генетики МНПЦ наркологии ДЗМ</p>
	<style>
		p {
		color: #000000;
		text-align: right;
		font-size: 11px;
	}
	</style>
	';

	// вывод подписи 
	$pdf->WriteHTMLCell(140, 20, '60', '259', "$sign", 0,0);


	//страница 2
		$pdf->AddPage('P', 'A4');

		
	//вертикальная позиция для столбца
	$y = $pdf->getY();

	//левая колонка
	//цвет фона
	$pdf->SetFillColor(75, 120, 114);

	//вывод колонки
	$pdf->writeHTMLCell(21, '295', '1', '1', $left_column, 0, 0, 1, true, 'J', true);

	//вертикальный текст - начало
	$pdf->StartTransform();
	// Rotate of degrees
	$pdf->Rotate(90, 58, 145);
	$pdf->SetDrawColor(255);
	$pdf->SetTextColor(255);
	$pdf->Text(40, 95, "ОБЩИЕ РЕКОМЕНДАЦИИ");

	//вертикальный текст - конец
	$pdf->StopTransform();

	//цвет текста
	$pdf->SetTextColor(0);

	//таблица данных пациента
	$table1 = <<<EOD
	<table>
	<tr>
	<td><strong>Фамилия</strong></td>
	<td>$InputSurname</td>
	<td><strong>ID</strong></td>
	<td>$InputId</td>
	</tr>
	<tr>
	<td>Имя</td>
	<td>$InputFirstName</td>
	<td>Дата рождения</td>
	<td>$InputBirth</td>
	</tr>
	<tr>
	<td>Отчество</td>
	<td>$InputSecondName</td>
	<td>Пол</td>
	<td>$InputSex</td>
	</tr>
	<tr>
	<td>Вес</td>
	<td>$InputWeight</td>
	<td>Раса</td>
	<td>$InputRase</td>
	</tr>
	<tr>
	<td>Рост</td>
	<td>$InputHeight</td>
	<td>Дата</td>
	<td>$InputDate</td>
	</tr>
	</table>
	<style>
	table {
		font-size: 11px;
		border: solid 1px #000000;
	}
	</style>
	EOD;

	//вывод таблицы
	$pdf->WriteHTMLCell(140, 30, '23', '20', "$table1", 1,0);

	$tableGenesRow = "";
	if (isset($_POST['columns'])){
		$firstStepColumns = json_decode($_POST['columns']);
		foreach($firstStepColumns as $key => $column){
			$tableGenesRow .= 
			'<tr>
				<td style="color: #FFFFFF; background-color: #5DACA1;">'.$column[0].'</td>
				<td>'.$column[1].'</td>
				<td>'.$column[2].'</td>
				<td>'.$column[3].'</td>
				<td>'.$column[4].'</td>';
				if($column[5]==1){
					$tableGenesRow .= '<td>Статус 1</td>';
				}elseif($column[5]==2){
					$tableGenesRow .= '<td>Статус 2</td>';
				}else{
					$tableGenesRow .= '<td>Статус 3</td>';
				}  	
			$tableGenesRow .= '</tr>';
		}
	}

	//таблица генов
	$table_genes = '
	<table>
	<tr>
	<th>ГЕН</th>
	<th>ПОЛИМОРФИЗМ</th>
	<th>АЛЛЕЛЬ</th>
	<th>RS</th>
	<th>ГЕНОТИП</th>
	<th>АКТИВНОСТЬ</th>
	</tr>
	'.$tableGenesRow.'
	</table>

	<style>
	th {
		font-size: 10px;
		color: #FFFFFF;
		background-color: #4B7872;
		text-align: center;
		width: 85px;
		height: 18px;
	}
	td {
		font-size: 10px;
		text-align: center;
	}
	</style>
	';

	//вывод таблицы
	$pdf->WriteHTMLCell(165, '', '25', '64', "$table_genes", 0,0);
	
	//текст 
	$text_page2 = '
	<p>Имеются данные, свидетельствующие о наличии генетически обусловленных отклонений в скорости метаболизма, что может увеличить риск развития нежелательных реакций на назначаемые лекарственные препараты и, в связи с этим, недостаточной эффективности терапии.</p>
	<p>Снижение активности CYP2C19, CYP2D6, CYP3A5 и ABCB1 будет приводить к замедлению элиминации большей части лекарственных средств: антидепрессантов, антипсихотиков, транквилизаторов и антиконвульсантов, то есть к возрастанию риска развития нежелательных реакций. 
	</p>
	<style>
		p {
		color: #000000;
		font-size: 11px;
	}
	</style>
	';

	// вывод текста
	$pdf->WriteHTMLCell(160, 90, '30', '150', "$text_page2", 0,0);

	// треугольники
	$style = array('width' => 0.5, 'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'phase' => 0, 'color' => array(0, 0, 0));
	$style2 = array('width' => 0.5, 'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(0, 0, 0));
	$style3 = array('width' => 0.5, 'cap' => 'round', 'join' => 'round', 'dash' => 0, 'color' => array(0, 0, 0));
	$style4 = array('L' => 0,
									'T' => array('width' => 0.25, 'cap' => 'butt', 'join' => 'miter', 'dash' => '20,10', 'phase' => 10, 'color' => array(100, 100, 255)),
									'R' => array('width' => 0.50, 'cap' => 'round', 'join' => 'miter', 'dash' => 0, 'color' => array(50, 50, 127)),
									'B' => array('width' => 0.75, 'cap' => 'square', 'join' => 'miter', 'dash' => '30,10,5,10'));
	$style5 = array('width' => 0.5, 'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(49, 21, 168));
	$style6 = array('width' => 0.5, 'cap' => 'butt', 'join' => 'miter', 'dash' => '10,10', 'color' => array(0, 128, 0));
	$style7 = array('width' => 0.5, 'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(168, 24, 21));


	$pdf->Line(40, 219, 40, 270, $style2); //вертикальная линия
	$pdf->Line(42, 244, 196, 244, $style3); //горизонтальная линия

	//текст
	$pdf->WriteHTMLCell(15, 10, '27', '218', "<small>200%</small>");
	$pdf->WriteHTMLCell(15, 10, '27', '230', "<small>150%</small>");
	$pdf->WriteHTMLCell(15, 10, '27', '242', "<small>100%</small>");
	$pdf->WriteHTMLCell(15, 10, '29', '254', "<small>50%</small>");
	$pdf->WriteHTMLCell(15, 10, '30', '266', "<small>0%</small>");

	//текст
	$pdf->WriteHTMLCell(30, 20, '28', '277', "<small>Активность</small>");
	$pdf->WriteHTMLCell(30, 20, '50', '277', "<small>CYP2C19*2</small>");
	$pdf->WriteHTMLCell(30, 20, '72', '277', "<small>CYP2C19*3</small>");
	$pdf->WriteHTMLCell(30, 20, '94', '277', "<small>CYP2C19*17</small>");
	$pdf->WriteHTMLCell(30, 20, '118', '277', "<small>CYP2D6*4</small>");
	$pdf->WriteHTMLCell(30, 20, '138', '277', "<small>CYP3A4*22</small>");
	$pdf->WriteHTMLCell(30, 20, '160', '277', "<small>CYP3A5*3</small>");
	$pdf->WriteHTMLCell(30, 20, '182', '277', "<small>ABCB1*6</small>");

	// треугольник вверх 
	$pdf->RegularPolygon(104, 238, 12, 3, 60, '', 'DF', $style6, array(50, 59, 159));
	// текст треугольника
	$persent_up = '
	<p>+95%</p>
	<style>
	p {
		color: #FFFFFF;
		font-size: 9px;
	}
	</style> 
	';
	$pdf->WriteHTMLCell(20, 20, '98', '235', $persent_up);

	// треугольник низ 
	$pdf->RegularPolygon(125, 250, 12, 3, 0, '', 'DF', $style6, array(168, 24, 48));
	// текст треугольника 
	$persent_down = '
	<p>-95%</p>
	<style>
	p {
		color: #FFFFFF;
		font-size: 9px;
	}
	</style>
	';
	$pdf->WriteHTMLCell(20, 20, '120', '249', $persent_down);


	//страница 3
		$pdf->AddPage('L', 'A4');
		
	//таблица
	//цвет фона
	$pdf->SetFillColor(75, 120, 114);

	// цвет текста
	//$pdf->SetTextColor(255, 255, 255);

	$tableDrugsRow = '';
	if (isset($_POST['drugs'])){
		$secondStepColumns = json_decode($_POST['drugs']);
		foreach($secondStepColumns as $key => $column){
			$tableDrugsRow .= 
			'<tr>
				<td style="color: #4B7872">'.$column[0].'</td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
			</tr>';
		}
	}

	// хедер таблицы
	$header_table_extended = '
	<br><h4>СПЕЦИФИЧЕСКИЕ РЕКОМЕНДАЦИИ</h4>
	<style>
	h4 {
		font-size: 14px;
		text-align: center;
		color: #FFFFFF;
		font-weight: regular;
	}
	</style>
	';

	$pdf->writeHTMLCell(288, '24', '4', '4', $header_table_extended, 0, 0, 1, true, 'J', true);


	//таблица
	$table_extended = '
	<table>
		<tr>
		<th style="color: #FFFFFF; background-color: #5DACA1;">СИОЗС</th>
		<th style="color: #FFFFFF; background-color: #5DACA1;">РЕКОМЕНДАЦИИ</th>
		<th style="color: #FFFFFF; background-color: #5DACA1;">ФАРМАКО<br>ДИНАМИКА</th>
		<th style="color: #FFFFFF; background-color: #5DACA1;">ДЕЙСТВИЕ</th>
		<th style="color: #FFFFFF; background-color: #5DACA1;">ФАРМАКО<br>КИНЕТИКА</th>
		<th style="color: #FFFFFF; background-color: #5DACA1;">ДЕЙСТВИЕ</th>
		<th style="color: #FFFFFF; background-color: #5DACA1;">ПОЛИПРАГМАЗИЯ<br>И ДРУГИЕ ФАКТОРЫ</th>
		</tr>
		'.$tableDrugsRow.'
	</table>

	<style>
	th {
		font-size: 11.5px;
		color: #FFFFFF;
		background-color: #4B7872;
		text-align: center;
		border: solid 1px #FFFFFF;
	}
	td {
		font-size: 10px;
		text-align: center;
		font-weight: bold;
		color: #000000;
		border: solid 1px #A5C5C1;
		height: 40px;
	}
	</style>
	';

	//вывод таблицы
	$pdf->WriteHTMLCell(290, 15, '3', '30', "$table_extended", 0, 0); 
	$pdf->Output('PharmacoGenomeX2 - Report.pdf', 'I');


	//вывод данных
	echo $pdf;
}catch (PDOExeption $e){
	return $e->getMessage;
}