<?php
/**
 * Get tenant status list
 *
 * @return array $status
 */
function getTenantStatuses()
{
    $status = array(1 => array('name' => 'Created', 'class' => 'primary'),
        2 => array('name' => 'Running', 'class' => 'success'),
        3 => array('name' => 'Suspend', 'class' => 'danger'),
        4 => array('name' => 'Resume', 'class' => 'info')
    );
    return $status;
}

/**
 * Get Tenant status 
 *
 * @param integer $status_id
 * @return string $status
 */
function getTenantStatus($status_id)
{
    $status_list = getTenantStatuses();
    return $status_list[$status_id]['name'];
}

/**
 * Return class for given tenant status id
 *
 * @param $status_id
 * @return mixed
 */
function getClassForTenantStatus($status_id)
{
    $status_list = getTenantStatuses();
    return $status_list[$status_id]['class'];
}

/**
 * Return Tenant Status list to show in the Detail view based on the given status Id
 *
 * @param integer $status_id
 * @return array $status_list
 */
function getTenantStatusListBasedOnStatus($status_id)
{
    $status_list = getTenantStatuses();
    unset($status_list[$status_id]);
    if($status_id == 2) {
        unset($status_list[1]); unset($status_list[4]);
    }
    else if($status_id == 3)    {
        unset($status_list[1]); unset($status_list[2]);
    }
    return $status_list;
}

/**
 * Return given user's full name
 *
 * @param integer $user_id
 * @return string $name
 */
function getUserFullName($user_id)
{
    $user = \Illuminate\Support\Facades\DB::table('saas_users')->where('id', $user_id)->get(array('name'));
    $name = $user[0]->name;
    return $name;
}

/**
 * Show checkbox value
 *
 * @param integer
 * @return string
 */
function showCheckBoxValue($value)
{
    if($value == 0 || empty($value))
        return 'Off';

    return 'On';
}
