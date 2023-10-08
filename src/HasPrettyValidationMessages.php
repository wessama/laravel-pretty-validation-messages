<?php

namespace WessamA\LaravelPrettyValidationMessages;

/**
 * Trait HasPrettyValidationMessages
 *
 * Used with any form requests requiring
 * custom validation messages from localization files.
 */
trait HasPrettyValidationMessages
{
    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages() : array
    {
        $messages = [];
        $rules = $this->rules();

        foreach ($rules as $field => $ruleList) {
            $rulesArray = is_string($ruleList) ? explode('|', $ruleList) : $ruleList;

            foreach ($rulesArray as $rule) {
                $ruleString = is_string($rule) ? $rule : get_class($rule);
                $messageKey = 'validation.forms.' . $this->fqcn() . ".{$field}.{$ruleString}";

                if (trans()->has($messageKey)) {
                    $messages["{$field}.{$ruleString}"] = trans($messageKey);
                }
            }
        }

        return $messages;
    }

    /**
     * Get the fully qualified class name of the request.
     *
     * @return string
     */
    private function fqcn() : string
    {
        return get_class($this);
    }
}
