#pragma once
inline void new_object(const char* class_name, zval* self) {
    zend_string* str = zend_string_init(class_name, strlen(class_name), false);
    zend_class_entry *ce = zend_lookup_class(str);
    object_init_ex(self, ce);
}
inline zval new_object(const char* class_name) {
    zval self;
    new_object(class_name, &self);
    return self;
}