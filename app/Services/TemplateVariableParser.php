<?php

namespace App\Services;

use Illuminate\Support\Facades\File;

class TemplateVariableParser
{
    protected static array $standardVars = [
        'landingPage', 'services', 'plans', 'faqs', 'projects',
        'service', 'plan', 'faq', 'project', 'feature', 'index', 'loop',
        'slot', 'attributes', 'component', 'errors', 'message',
    ];

    public static function parse(string $viewFile): array
    {
        $path = resource_path('views/' . str_replace('.', '/', $viewFile) . '.blade.php');

        if (!File::exists($path)) {
            return [];
        }

        $content = File::get($path);
        $variables = [];

        // Pattern 1: {{-- @var name:type --}} (primary method)
        if (preg_match_all('/@var\s+(\w+)\s*:\s*(\w+)/', $content, $matches)) {
            foreach ($matches[1] as $i => $name) {
                $variables[$name] = self::normalizeType($matches[2][$i]);
            }
        }

        // Pattern 2: auto-detect $camelCase outside @php blocks
        // Strip @php...@endphp blocks to avoid detecting local variables
        $contentOutsidePhp = preg_replace('/@php[\s\S]*?@endphp/', '', $content);
        // Also strip Blade directives like @foreach($items as $item)
        $contentOutsidePhp = preg_replace('/@\w+\([^)]*\)/', '', $contentOutsidePhp);

        if (preg_match_all('/\$(\b[a-z][a-zA-Z0-9]*\b)/', $contentOutsidePhp, $matches)) {
            foreach ($matches[1] as $name) {
                if (in_array($name, self::$standardVars) || isset($variables[$name])) {
                    continue;
                }
                // Skip if it looks like a loop variable (used with ->)
                if (preg_match('/\$' . preg_quote($name, '/') . '\s*->/', $contentOutsidePhp)) {
                    continue;
                }
                // Skip if it's assigned (local variable)
                if (preg_match('/\$' . preg_quote($name, '/') . '\s*=/', $content)) {
                    continue;
                }
                $variables[$name] = self::inferType($name);
            }
        }

        return $variables;
    }

    protected static function normalizeType(string $type): string
    {
        return match(strtolower($type)) {
            'image', 'img', 'photo', 'file' => 'image',
            'toggle', 'bool', 'boolean' => 'toggle',
            default => 'text',
        };
    }

    protected static function inferType(string $name): string
    {
        $lower = strtolower($name);

        if (str_contains($lower, 'image') || str_contains($lower, 'img')
            || str_contains($lower, 'photo') || str_contains($lower, 'bg')
            || str_contains($lower, 'background') || str_contains($lower, 'cover')
            || str_contains($lower, 'logo') || str_contains($lower, 'banner')
            || str_contains($lower, 'avatar')) {
            return 'image';
        }

        if (str_starts_with($lower, 'show') || str_starts_with($lower, 'enable')
            || str_starts_with($lower, 'is') || str_starts_with($lower, 'has')
            || str_starts_with($lower, 'active') || str_starts_with($lower, 'use')) {
            return 'toggle';
        }

        return 'text';
    }
}
