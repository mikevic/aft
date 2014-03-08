<?php
if($x_type != 'unset'){
      $where_query .= " AND `Exchange Type` LIKE '%$x_type%'";
    }
    if($fow != 'unset'){
      if($search_scope != 'primary-secondary'){
        $or_code = generate_or_code($fow, 'primary fow');
        $where_query .= " AND ($or_code)";
      } else {
        $or_code = generate_or_code($fow, 'primary fow');
        $or_code1 = generate_or_code($fow, 'secondary fow');
        $where_query .= " AND (($or_code) OR ($or_code1))";
      }
      if($background != 'unset'){
        if($search_scope != 'primary-secondary'){
          $or_code = generate_or_code($background, 'Background in primary field of work', 'search');
          $where_query .= " AND ($or_code)";
        } else {
          $or_code = generate_or_code($background, 'Background in primary field of work', 'search');
          $or_code1 = generate_or_code($background, 'Background in secondary field of work', 'search');
          $where_query .= " AND (($or_code) OR ($or_code1))";
        }
      }
    }
    if($master_issue != 'unset'){
      $or_code = generate_or_code($master_issue, 'Master Issues', 'search');
      $where_query .= " AND ($or_code)";
    }
    if($sub_issue != 'unset'){
      $or_code = generate_or_code($sub_issue, 'Sub Issues', 'search');
      $where_query .= " AND ($or_code)";
    }
    if($skills != 'unset'){
      $or_code = generate_or_code($skills, 'Skills', 'search');
      $where_query .= " AND ($or_code)";
    }
    if($duration != 'unset'){
      switch ($duration) {
        case '1':
           $duration_start = 2419200;
           $duration_end = 4838400;
          break;

        case '2':
           $duration_start = 4838400;
           $duration_end = 7257600;
          break;

        case '3':
           $duration_start = 7257600;
           $duration_end = 14515200;
          break;

        case '4':
           $duration_start = 14515200;
           $duration_end = 31449600;
          break;

        case '5':
           $duration_start = 31449600;
           $duration_end = 1391006006;
          break;

        default:
          # code...
          break;
      }
      $where_query .= " AND ((`Latest End Date` -  `Earliest Start Date`) > $duration_start AND (`Latest End Date` - `Earliest Start Date`) < $duration_end)";
    }
    if($startdate != 'unset' && $enddate != 'unset'){
      $sd_ts = strtotime($startdate);
      $ed_ts = strtotime($enddate);
      $where_query .= " AND (`Earliest Start Date` > $sd_ts AND `Latest End Date` < $ed_ts)";
    }
?>