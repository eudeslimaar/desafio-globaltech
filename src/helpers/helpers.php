<?php

/**
 * Renderiza un modelo con lo dados ofrecidos.
 *
 * @param string $template
 * @param array $data
 * @return false|string
 * @throws Exception
 */
function view(string $template, array $data = []): false|string
{
    $templatePath = __DIR__ . '/../views/' . str_replace('.', '/', $template) . '.php';

    if (!file_exists($templatePath)) {
        throw new Exception("Template $templatePath no encontrado.");
    }

    extract($data);

    ob_start();
    include $templatePath;
    return ob_get_clean();
}
