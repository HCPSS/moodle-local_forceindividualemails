<?php

if ($hassiteconfig) {
    $settings = new admin_settingpage(
        'local_forceindividualemails',
        'Force Individual Emails Configuration'
    );

    $ADMIN->add('localplugins', $settings);

    /** @var \moodle_database */
    $data = $DB->get_records_sql("
        SELECT
            f.id,
            f.name,
            f.course,
            c.fullname,
            c.shortname
        FROM {forum} f

        LEFT JOIN {course} c
        ON f.course = c.id
    ");

    $choices = [];
    foreach ($data as $row) {
        $choices[$row->id] = "{$row->shortname}: {$row->name}";
    }

    $settings->add(new admin_setting_configmulticheckbox(
        'local_forceindividualemails/forums',
        'Forums',
        'The forums for which to force individual emails.',
        [],
        $choices
    ));
}
