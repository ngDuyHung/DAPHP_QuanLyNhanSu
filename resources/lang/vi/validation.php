<?php

return [

    'accepted' => 'Trường :attribute phải được chấp nhận.',
    'accepted_if' => 'Trường :attribute phải được chấp nhận khi :other là :value.',
    'active_url' => 'Trường :attribute không phải là URL hợp lệ.',
    'after' => 'Trường :attribute phải là ngày sau :date.',
    'after_or_equal' => 'Trường :attribute phải là ngày sau hoặc bằng :date.',
    'alpha' => 'Trường :attribute chỉ được chứa chữ cái.',
    'alpha_dash' => 'Trường :attribute chỉ được chứa chữ cái, số, dấu gạch ngang và gạch dưới.',
    'alpha_num' => 'Trường :attribute chỉ được chứa chữ cái và số.',
    'array' => 'Trường :attribute phải là mảng.',
    'before' => 'Trường :attribute phải là ngày trước :date.',
    'before_or_equal' => 'Trường :attribute phải là ngày trước hoặc bằng :date.',
    'between' => [
        'numeric' => 'Trường :attribute phải nằm trong khoảng :min đến :max.',
        'file' => 'Trường :attribute phải có dung lượng từ :min đến :max KB.',
        'string' => 'Trường :attribute phải có từ :min đến :max ký tự.',
        'array' => 'Trường :attribute phải có từ :min đến :max phần tử.',
    ],
    'boolean' => 'Trường :attribute phải là true hoặc false.',
    'confirmed' => 'Xác nhận :attribute không khớp.',
    'current_password' => 'Mật khẩu hiện tại không đúng.',
    'date' => 'Trường :attribute không phải là ngày hợp lệ.',
    'date_equals' => 'Trường :attribute phải bằng ngày :date.',
    'date_format' => 'Trường :attribute không đúng định dạng :format.',
    'declined' => 'Trường :attribute phải bị từ chối.',
    'different' => 'Trường :attribute và :other phải khác nhau.',
    'digits' => 'Trường :attribute phải có :digits chữ số.',
    'digits_between' => 'Trường :attribute phải có từ :min đến :max chữ số.',
    'email' => 'Trường :attribute phải là email hợp lệ.',
    'exists' => 'Giá trị đã chọn của :attribute không tồn tại.',
    'file' => 'Trường :attribute phải là tập tin.',
    'filled' => 'Trường :attribute không được để trống.',
    'image' => 'Trường :attribute phải là hình ảnh.',
    'in' => 'Giá trị đã chọn của :attribute không hợp lệ.',
    'integer' => 'Trường :attribute phải là số nguyên.',
    'max' => [
        'numeric' => 'Trường :attribute không được lớn hơn :max.',
        'file' => 'Trường :attribute không được lớn hơn :max KB.',
        'string' => 'Trường :attribute không được lớn hơn :max ký tự.',
        'array' => 'Trường :attribute không được có nhiều hơn :max phần tử.',
    ],
    'min' => [
        'numeric' => 'Trường :attribute phải lớn hơn hoặc bằng :min.',
        'file' => 'Trường :attribute phải có ít nhất :min KB.',
        'string' => 'Trường :attribute phải có ít nhất :min ký tự.',
        'array' => 'Trường :attribute phải có ít nhất :min phần tử.',
    ],
    'nullable' => 'Trường :attribute có thể để trống.',
    'numeric' => 'Trường :attribute phải là số.',
    'password' => 'Mật khẩu không đúng.',
    'required' => 'Trường :attribute không được để trống.',
    'same' => 'Trường :attribute và :other phải giống nhau.',
    'string' => 'Trường :attribute phải là chuỗi.',
    'unique' => 'Trường :attribute đã tồn tại.',
    'url' => 'Trường :attribute phải là URL hợp lệ.',

    /*
    |--------------------------------------------------------------------------
    | Custom Attribute Names
    |--------------------------------------------------------------------------
    */
    'attributes' => [
        'name' => 'tên',
        'email' => 'email',
        'password' => 'mật khẩu',
        'password_confirmation' => 'xác nhận mật khẩu.',
    ],

];
