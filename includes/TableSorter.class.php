<?
/*
 * 2012 Jan 27
 * Web Host interface system
 *
 * Table Sorter Data Model
 *
 * @author Kobe Sun
 *
 */


class TableSorter
{
	static function returnMetaStr($start,$rows,$totalRows,$count,$orderBy='',$where='')
	{
		$nextStart = $start;
		if($nextStart<=0){
			$nextStart=0;
		}
		
		$nextRows = $start+$rows;
		
		if($totalRows-$start<$rows){
			$toRecord = $totalRows;
		}
		else{
			$toRecord = $start+$rows;
		}
		
		if($nextStart>0){
			$PagePrev = '<a id="PagePrev" title="'.$nextStart.'">&#171; 前一页</a> &nbsp; <a>|</a> &nbsp;';
		}
		else{
			$PagePrev = '&#171; 前一页 &nbsp; | &nbsp;<span id="PagePrev"></span>';
		}

		if($count<$rows || $rows==0){
			$PageNext = '后一页 &#187;<span id="PageNext"></span>';
		}
		else{
			$PageNext = '<a id="PageNext" title="'.($start+$rows).'">后一页 &#187;</a>';
		}
		
		return '<tr>
				<td colspan="10" class="MetaData">
					共有记录: '.$totalRows.' 
					&nbsp; // &nbsp; 
					显示 '.$count.' 记录 ('.$start.' - '.$toRecord.') 
					&nbsp;&nbsp; '.$PagePrev.' '.$PageNext.'
				</td></tr>';
	}
	
	static function returnSubMetaStr($start,$rows,$totalRows,$count,$orderBy='',$where='')
	{
		$nextStart = $start;
		if($nextStart<=0){
			$nextStart=0;
		}
		
		$nextRows = $start+$rows;
		
		if($totalRows-$start<$rows){
			$toRecord = $totalRows;
		}
		else{
			$toRecord = $start+$rows;
		}
		
		if($nextStart>0){
			$PagePrev = '<a id="SubPagePrev" title="'.$nextStart.'">&#171; 前一页</a> &nbsp; <a>|</a> &nbsp;';
		}
		else{
			$PagePrev = '&#171; 前一页 &nbsp; | &nbsp;<span id="SubPagePrev"></span>';
		}
		
		if($count<$rows){
			$PageNext = '后一页 &#187;<span id="SubPageNext"></span>';
		}
		else{
			$PageNext = '<a id="SubPageNext" title="'.($start+$rows).'">后一页 &#187;</a>';
		}
		
		return '<tr>
				<td colspan="10" class="MetaData">
					共有记录: '.$totalRows.' 
					&nbsp; // &nbsp; 
					显示 '.$count.' 记录 ('.$start.' - '.$toRecord.') 
					&nbsp;&nbsp; '.$PagePrev.' '.$PageNext.'
				</td></tr>';
	}
}
?>