<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages here.
    |
    */

    'accepted' => 'Trường :attribute phải được chấp nhận.',
    'accepted_if' => 'Trường :attribute phải được chấp nhận khi trường :other là :value.',
    'active_url' => 'Trường :attribute phải là một URL hợp lệ.',
    'after' => 'Trường :attribute phải là một ngày sau ngày :date.',
    'after_or_equal' => 'Trường :attribute phải là một ngày sau hoặc bằng ngày :date.',
    'alpha' => 'Trường :attribute chỉ được phép chứa các chữ cái.',
    'alpha_dash' => 'Trường :attribute chỉ được phép chứa các chữ cái, số, dấu gạch ngang và dấu gạch dưới.',
    'alpha_num' => 'Trường :attribute chỉ được phép chứa các chữ cái và chữ số.',
    'any_of' => 'Trường :attribute không hợp lệ.',
    'array' => 'Trường :attribute phải là một mảng.',
    'ascii' => 'Trường :attribute chỉ được phép chứa các ký tự chữ số và biểu tượng byte đơn.',
    'before' => 'Trường :attribute phải là một ngày trước ngày :date.',
    'before_or_equal' => 'Trường :attribute phải là một ngày trước hoặc bằng ngày :date.',
    'between' => [
        'array' => 'Trường :attribute phải có từ :min đến :max mục.',
        'file' => 'Dung lượng tệp :attribute phải nằm trong khoảng :min đến :max kilobytes.',
        'numeric' => 'Giá trị :attribute phải nằm trong khoảng từ :min đến :max.',
        'string' => 'Trường :attribute phải có từ :min đến :max ký tự.',
    ],
    'boolean' => 'Trường :attribute phải là giá trị đúng (true) hoặc sai (false).',
    'can' => 'Trường :attribute chứa một giá trị không được cấp quyền.',
    'confirmed' => 'Trường xác nhận :attribute không khớp.',
    'contains' => 'Trường :attribute đang thiếu một giá trị bắt buộc.',
    'current_password' => 'Mật khẩu không chính xác.',
    'date' => 'Trường :attribute không phải là một ngày hợp lệ.',
    'date_equals' => 'Trường :attribute phải là một ngày bằng với ngày :date.',
    'date_format' => 'Trường :attribute không khớp với định dạng :format.',
    'decimal' => 'Trường :attribute phải có đúng :decimal chữ số thập phân.',
    'declined' => 'Trường :attribute phải bị từ chối.',
    'declined_if' => 'Trường :attribute phải bị từ chối khi trường :other là :value.',
    'different' => 'Trường :attribute và trường :other phải khác nhau.',
    'digits' => 'Trường :attribute phải có đúng :digits chữ số.',
    'digits_between' => 'Trường :attribute phải có từ :min đến :max chữ số.',
    'dimensions' => 'Trường :attribute có kích thước hình ảnh không hợp lệ.',
    'distinct' => 'Trường :attribute có một giá trị bị trùng lặp.',
    'doesnt_contain' => 'Trường :attribute không được chứa bất kỳ giá trị nào sau đây: :values.',
    'doesnt_end_with' => 'Trường :attribute không được kết thúc bằng một trong các giá trị sau: :values.',
    'doesnt_start_with' => 'Trường :attribute không được bắt đầu bằng một trong các giá trị sau: :values.',
    'email' => 'Trường :attribute phải là một địa chỉ email hợp lệ.',
    'encoding' => 'Trường :attribute phải được mã hóa theo chuẩn: :encoding.',
    'ends_with' => 'Trường :attribute phải kết thúc bằng một trong các giá trị sau: :values.',
    'enum' => 'Giá trị :attribute được chọn không hợp lệ.',
    'exists' => 'Giá trị :attribute được chọn không tồn tại trên hệ thống.',
    'extensions' => 'Trường :attribute phải có một trong các phần mở rộng sau: :values.',
    'file' => 'Trường :attribute phải là một tệp tin.',
    'filled' => 'Trường :attribute bắt buộc phải nhập dữ liệu.',
    'gt' => [
        'array' => 'Trường :attribute phải có nhiều hơn :value mục.',
        'file' => 'Dung lượng tệp :attribute phải lớn hơn :value kilobytes.',
        'numeric' => 'Giá trị :attribute phải lớn hơn :value.',
        'string' => 'Trường :attribute phải có nhiều hơn :value ký tự.',
    ],
    'gte' => [
        'array' => 'Trường :attribute phải có từ :value mục trở lên.',
        'file' => 'Dung lượng tệp :attribute phải lớn hơn hoặc bằng :value kilobytes.',
        'numeric' => 'Giá trị :attribute phải lớn hơn hoặc bằng :value.',
        'string' => 'Trường :attribute phải có nhiều hơn hoặc bằng :value ký tự.',
    ],
    'hex_color' => 'Trường :attribute phải là một mã màu hexadecimal hợp lệ.',
    'image' => 'Trường :attribute phải là một định dạng hình ảnh.',
    'in' => 'Giá trị :attribute đã chọn không hợp lệ.',
    'in_array' => 'Trường :attribute phải tồn tại trong trường :other.',
    'in_array_keys' => 'Trường :attribute phải chứa ít nhất một trong các khóa sau: :values.',
    'integer' => 'Trường :attribute phải là một số nguyên.',
    'ip' => 'Trường :attribute phải là một địa chỉ IP hợp lệ.',
    'ipv4' => 'Trường :attribute phải là một địa chỉ IPv4 hợp lệ.',
    'ipv6' => 'Trường :attribute phải là một địa chỉ IPv6 hợp lệ.',
    'json' => 'Trường :attribute phải là một chuỗi JSON hợp lệ.',
    'list' => 'Trường :attribute phải là một danh sách.',
    'lowercase' => 'Trường :attribute phải là chữ viết thường.',
    'lt' => [
        'array' => 'Trường :attribute phải có ít hơn :value mục.',
        'file' => 'Dung lượng tệp :attribute phải nhỏ hơn :value kilobytes.',
        'numeric' => 'Giá trị :attribute phải nhỏ hơn :value.',
        'string' => 'Trường :attribute phải có ít hơn :value ký tự.',
    ],
    'lte' => [
        'array' => 'Trường :attribute không được có nhiều hơn :value mục.',
        'file' => 'Dung lượng tệp :attribute phải nhỏ hơn hoặc bằng :value kilobytes.',
        'numeric' => 'Giá trị :attribute phải nhỏ hơn hoặc bằng :value.',
        'string' => 'Trường :attribute phải có ít hơn hoặc bằng :value ký tự.',
    ],
    'mac_address' => 'Trường :attribute phải là một địa chỉ MAC hợp lệ.',
    'max' => [
        'array' => 'Trường :attribute không được có nhiều hơn :max mục.',
        'file' => 'Dung lượng tệp :attribute không được lớn hơn :max kilobytes.',
        'numeric' => 'Giá trị :attribute không được lớn hơn :max.',
        'string' => 'Trường :attribute không được lớn hơn :max ký tự.',
    ],
    'max_digits' => 'Trường :attribute không được có nhiều hơn :max chữ số.',
    'mimes' => 'Trường :attribute phải là một tệp tin thuộc định dạng: :values.',
    'mimetypes' => 'Trường :attribute phải là một tệp tin thuộc định dạng: :values.',
    'min' => [
        'array' => 'Trường :attribute phải có ít nhất :min mục.',
        'file' => 'Dung lượng tệp :attribute phải tối thiểu là :min kilobytes.',
        'numeric' => 'Giá trị :attribute phải tối thiểu là :min.',
        'string' => 'Trường :attribute phải có tối thiểu :min ký tự.',
    ],
    'min_digits' => 'Trường :attribute phải có ít nhất :min chữ số.',
    'missing' => 'Trường :attribute phải được để trống.',
    'missing_if' => 'Trường :attribute phải được để trống khi trường :other là :value.',
    'missing_unless' => 'Trường :attribute phải được để trống trừ khi trường :other là :value.',
    'missing_with' => 'Trường :attribute phải được để trống khi trường :values xuất hiện.',
    'missing_with_all' => 'Trường :attribute phải được để trống khi tất cả trường :values xuất hiện.',
    'multiple_of' => 'Trường :attribute phải là một bội số của :value.',
    'not_in' => 'Giá trị :attribute được chọn không hợp lệ.',
    'not_regex' => 'Định dạng trường :attribute không hợp lệ.',
    'numeric' => 'Trường :attribute phải là một chữ số.',
    'password' => [
        'letters' => 'Mật khẩu phải chứa ít nhất một chữ cái.',
        'mixed' => 'Mật khẩu phải chứa ít nhất một chữ hoa và một chữ thường.',
        'numbers' => 'Mật khẩu phải chứa ít nhất một chữ số.',
        'symbols' => 'Mật khẩu phải chứa ít nhất một ký tự đặc biệt.',
        'uncompromised' => 'Mật khẩu đã nhập có nguy cơ bị rò rỉ dữ liệu. Vui lòng chọn một mật khẩu khác.',
    ],
    'present' => 'Trường :attribute phải có mặt trong dữ liệu gửi lên.',
    'present_if' => 'Trường :attribute phải có mặt khi trường :other là :value.',
    'present_unless' => 'Trường :attribute phải có mặt trừ khi trường :other là :value.',
    'present_with' => 'Trường :attribute phải có mặt khi trường :values xuất hiện.',
    'present_with_all' => 'Trường :attribute phải có mặt khi tất cả trường :values xuất hiện.',
    'prohibited' => 'Trường :attribute bị nghiêm cấm nhập.',
    'prohibited_if' => 'Trường :attribute bị nghiêm cấm nhập khi trường :other là :value.',
    'prohibited_if_accepted' => 'Trường :attribute bị nghiêm cấm nhập khi trường :other được chấp nhận.',
    'prohibited_if_declined' => 'Trường :attribute bị nghiêm cấm nhập khi trường :other bị từ chối.',
    'prohibited_unless' => 'Trường :attribute bị nghiêm cấm nhập trừ khi trường :other nằm trong nhóm: :values.',
    'prohibits' => 'Trường :attribute ngăn không cho trường :other xuất hiện.',
    'regex' => 'Định dạng trường :attribute không hợp lệ.',
    'required' => 'Trường :attribute bắt buộc phải nhập.',
    'required_array_keys' => 'Trường :attribute phải chứa các mục cho: :values.',
    'required_if' => 'Trường :attribute bắt buộc phải nhập khi trường :other là :value.',
    'required_if_accepted' => 'Trường :attribute bắt buộc phải nhập khi trường :other được chấp nhận.',
    'required_if_declined' => 'Trường :attribute bắt buộc phải nhập khi trường :other bị từ chối.',
    'required_unless' => 'Trường :attribute bắt buộc phải nhập trừ khi trường :other nằm trong nhóm: :values.',
    'required_with' => 'Trường :attribute bắt buộc phải nhập khi trường :values xuất hiện.',
    'required_with_all' => 'Trường :attribute bắt buộc phải nhập khi tất cả trường :values xuất hiện.',
    'required_without' => 'Trường :attribute bắt buộc phải nhập khi trường :values không xuất hiện.',
    'required_without_all' => 'Trường :attribute bắt buộc phải nhập khi không có trường nào trong nhóm :values xuất hiện.',
    'same' => 'Trường :attribute và trường :other phải trùng khớp với nhau.',
    'size' => [
        'array' => 'Trường :attribute phải chứa đúng :size mục.',
        'file' => 'Dung lượng tệp :attribute phải đúng :size kilobytes.',
        'numeric' => 'Giá trị :attribute phải bằng :size.',
        'string' => 'Trường :attribute phải có đúng :size ký tự.',
    ],
    'starts_with' => 'Trường :attribute phải được bắt đầu bằng một trong các giá trị sau: :values.',
    'string' => 'Trường :attribute phải là một chuỗi văn bản.',
    'timezone' => 'Trường :attribute phải là một múi giờ hợp lệ.',
    'unique' => 'Giá trị :attribute này đã tồn tại trên hệ thống.',
    'uploaded' => 'Tệp tin :attribute tải lên thất bại.',
    'uppercase' => 'Trường :attribute phải là chữ viết hoa.',
    'url' => 'Trường :attribute phải là một URL hợp lệ.',
    'ulid' => 'Trường :attribute phải là một mã ULID hợp lệ.',
    'uuid' => 'Trường :attribute phải là một mã UUID hợp lệ.',

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attribute.rule" to name the lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
    */

    'custom' => [
        'attribute-name' => [
            'rule-name' => 'custom-message',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap our attribute placeholder
    | with something more reader friendly such as "E-Mail Address" instead
    | of "email". This simply helps us make our message more expressive.
    |
    */

    'attributes' => [],

];
