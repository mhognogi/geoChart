<?
$arrJudRespAll = array(
    'B' => array(0 => ''),
    'AB' => array(1 => 'ATI',
        2 => 'Cardiologie',
        3 => 'Chirurgie'
    ),
);
?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script type="text/javascript" src="https://www.google.com/jsapi?fake=.js"></script>

<div id="data" ></div>
<div id="chart_div" ></div>

<style>
    #data{
        position: absolute;
        top: 0px;
        left: 0px;
        width: 200px;
    }
    .btn_map{
        position: absolute;
        top: 1px;
        right: 1px;
        color:#fff;
        background-color:#d00;
        padding:1px 3px 1px 3px;
        border: none;
        cursor: pointer;
    }
</style>

<script>
    function drawChart () {
        var data = new google.visualization.DataTable();
        data.addColumn('string', 'province');
        data.addColumn('number', 'value');
        data.addRows([
            ['RO-AB', 2],
            ['RO-AR', 3],
            ['RO-AG', 4],
            ['RO-BC', 5],
            ['RO-BH', 6],
            ['RO-BN', 7]
        ]);

        var chart = new google.visualization.GeoChart(document.getElementById('chart_div'));
        chart.draw(data, {
            region: 'RO',
            resolution: 'provinces',
            colors: ['white','Indigo','Blue','Green','Yellow','Orange','Red'],
        });
    }

    google.load('visualization', '1', {packages:['geochart'], callback: drawChart});

    //fix get corect height
    var tid = setInterval(myTimer, 200);
    function myTimer() {
        var height = $('#chart_div').height();
        if(height > 100){
            clearInterval(tid);
            calcJudXY();
        }
    }

    //fix GeoCart responsiv
    $(window).resize(function(event){
        location.reload();
    });

    function calcJudXY() {
        var position = $('#chart_div').offset();
        var posX = position.left;
        var posY = position.top;
        var width = $('#chart_div').width();
        var height = $('#chart_div').height();

        //judet
        <?
        $maxVert = 3;
        $title = 'title...';
        $strRep = 'str responsabili';
        $backgr = null;
        $cursor = " cursor:default; ";
        if($arrJudRespAll){
            foreach($arrJudRespAll as $jud => $arrResp){
                $plus = null;
                echo  "var jud = '$jud';";
                $cursor = null;
                $strTitle = implode('\\n', $arrResp);
                $title = "title='$jud\\n$strTitle'";
                if(count($arrResp) <= $maxVert){
                    $strRep = "<b>$jud</b><br>".implode('<br>',$arrResp);
                } else {
                    $arrResp2 = array_slice($arrResp, 0, $maxVert);
                    $plus = count($arrResp)-$maxVert;
                    $strRep = "<b>$jud</b><br>".implode('<br>',$arrResp2)."<br>...+$plus";
                    $cursor = 'cursor:default;';
                }
                $countResp = count($arrResp);

                //anulare beckground color div judete
                //$backgr = $arrColDiv[$countResp].'; ';
                $backgr = null;
                ?>
                var XYjud = defXYjud(jud);
                var judX = XYjud[0];
                var judY = XYjud[1];
                var widthLabel = 110;
                var offsetLabelX = -widthLabel/2;
                var percentX = width/1000;
                var divX = posX + judX*percentX + offsetLabelX;
                var percentY = height/1000;
                var divY = posY + judY*percentY;
                var style = "position:absolute; top:"+divY+"px; left:"+divX+"px; width:"+widthLabel+"px; z-index:1; text-align:center;";
                style += "height:auto; <?=$backgr.$cursor?> padding:0px; text-shadow: white 0px 0px 10px; color:#000;";
                var append = "<div style='"+style+"' <?=$title?> ><?=$strRep?></div>";
                $('#data').append(append);
            <?
            }
        }
        ?>
    }

    function defXYjud(jud) {
        //                    x(left), y(top)
        if(jud == 'AB') { return [372,420]; }; //ok
        if(jud == 'AR') { return [229,415]; }; //ok
        if(jud == 'AG') { return [490,644]; }; //ok
        if(jud == 'BC') { return [650,397]; }; //ok
        if(jud == 'BH') { return [260,280]; }; //ok
        if(jud == 'BN') { return [460,238]; }; //ok
        if(jud == 'BT') { return [654,103]; }; //ok
        if(jud == 'BR') { return [729,644]; }; //ok
        if(jud == 'BV') { return [530,502]; }; //ok
        if(jud == 'B') { return [594,780]; }; //ok
        if(jud == 'BZ') { return [650,601]; }; //ok
        if(jud == 'CL') { return [680,800]; }; //ok
        if(jud == 'CS') { return [254,610]; }; //ok
        if(jud == 'CJ') { return [373,312]; }; //ok
        if(jud == 'CT') { return [775,781]; }; //ok
        if(jud == 'CV') { return [583,492]; }; //ok
        if(jud == 'DB') { return [546,669]; }; //ok
        if(jud == 'DJ') { return [380,820]; }; //ok
        if(jud == 'EX') { return [, ]; };
        if(jud == 'GL') { return [733,510 ]; }; //ok
        if(jud == 'GR') { return [582,825]; }; //ok
        if(jud == 'GJ') { return [350,670]; }; //ok
        if(jud == 'HR') { return [552,370 ]; }; //ok
        if(jud == 'HD') { return [330,510 ]; }; //ok
        if(jud == 'IL') { return [690,730]; }; //ok
        if(jud == 'IS') { return [700,240]; }; //ok
        if(jud == 'IF') { return [600,760]; }; //ok
        if(jud == 'MM') { return [415,140]; }; //ok
        if(jud == 'MH') { return [310,740]; }; //ok
        if(jud == 'MS') { return [470,345]; }; //ok
        if(jud == 'NT') { return [625,280]; }; //ok
        if(jud == 'OT') { return [450,785]; }; //ok
        if(jud == 'SJ') { return [343,240]; }; //ok
        if(jud == 'SM') { return [320,130]; }; //ok
        if(jud == 'SB') { return [435,490]; }; //ok
        if(jud == 'SV') { return [565,170]; }; //ok
        if(jud == 'TR') { return [515,842]; }; //ok
        if(jud == 'TM') { return [190,520]; }; //ok
        if(jud == 'TL') { return [830,650]; }; //ok
        if(jud == 'VL') { return [425,630]; }; //ok
        if(jud == 'VS') { return [738, 370]; }; //ok
        if(jud == 'VN') { return [660,500]; }; //ok
        if(jud == 'PH') { return [590,620]; };

        return null;
    }

function arata_map() {

}
</script>


