<?php
/**
 *
 * Checks if user(data) already exists in our saved file.
 *
 * If there is no such data(user) returns true.
 * If the data already exist in file, writes an error and returns false.
 *
 * @param string $field_input - clean input value
 * @param array $field - input array
 * @return bool
 */
function validate_user_unique(string $field_input, array &$field): bool
{
    $fileDB = new FileDB(DB_FILE);
    $fileDB->load();

    if ($fileDB->getRowWhere('users', ['email' => $field_input])) {
        $field['error'] = 'Toks vartotojas jau egzistuoja';

        return false;
    }

    return true;
}

/**
 *
 *Checks if there is such email and password in the database.
 *
 * If there is such user and password is the same as in database returns true.
 * If email or password of $filtered_input are not in the database(or not the same),
 * writes an error and returns false.
 *
 * @param array $filtered_input - clean inputs array with values
 * @param array $form - form array
 * @return bool
 */
function validate_login(array $filtered_input, array &$form): bool
{
    $fileDB = new FileDB(DB_FILE);
    $fileDB->load();

    if ($fileDB->getRowWhere('users', [
        'email' => $filtered_input['email'],
        'password' => $filtered_input['password']
    ])) {
        return true;
    }

    $form['error'] = 'Suvesti neteisingi duomenys';

    return false;
}

/**
 * Checks if values have already been written in database.
 *
 * @param array $form_values
 * @param array $form
 * @param array $params
 * @return bool
 */
function validate_field_coordinates(array $form_values, array &$form, array $params): bool
{
    $fileDB = new FileDB(DB_FILE);

    $fileDB->load();

    if ($fileDB->getRowWhere('pixels', [
        $params[0] => $form_values[$params[0]],
        $params[1] => $form_values[$params[1]],
    ])) {
        $form['error'] = 'These coordinates are already taken, choose new ones';

        return false;
    }

    return true;
}