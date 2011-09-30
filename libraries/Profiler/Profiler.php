<?php

/**
 * A profiler for developers.
 *
 * @author  DE BONA Vivien <debona.vivien@gmail.com>
 * @version 1.0
 */
class Profiler
{
    // Protected attributes for configuration
    protected   $frontControllerPath,
                $thisFilePath;

    // Protected attributes
    protected   $get        = array(),
                $post       = array(),
                $session    = array(),
                $queries    = array(),
                $files      = array(),
                $_sections  = array(),

                $_available_sections = array(
                    'get',
                    'post',
                    'queries',
                    'files',
                    'session'
                );
    /**
     * Constructor
     *
     * @param array $queriesArray An array of the excuted queries
     */
    public function __construct($frontControllerPath, $thisFilePath, $queriesArray)
    {
        // Configuration attributes
        $this->frontControllerPath  = $frontControllerPath;
        $this->thisFilePath         = $thisFilePath;

        $this->get      = $_GET;
        $this->post     = $_POST;
        $this->session  = ((!empty($_SESSION)) ? $_SESSION : null);
        $this->queries  = $queriesArray;
        $this->files    = get_included_files();
    }

    /**
     * Displays the profiler informations
     */
    public function display()
    {
        foreach ($this->_available_sections as $section)
        {
            $func = "_compile_{$section}";
            $this->_sections[$section] = $this->{$func}();
        }

        $libraryPath    = $this->thisFilePath;
        $fcPath         = $this->frontControllerPath;
        $sections       = $this->_sections;
        include 'template.html';
    }

    /**
     * Compiles $_GET
     */
    protected function _compile_get()
    {
        $output = array();

        if (0 == count($this->get))
        {
            $output = 'Il n\'y a pas de variable $_GET.';
        }
        else
        {
            foreach ($this->get as $key => $val)
            {
                if ( ! is_numeric($key))
                {
                    $key = "'".$key."'";
                }

                if (is_array($val))
                {
                    $output['&#36;_GET['. $key .']'] = '<pre>'. htmlspecialchars(stripslashes(print_r($val, TRUE))) . '</pre>';
                }
                else
                {
                    $output['&#36;_GET['. $key .']'] = htmlspecialchars(stripslashes($val));
                }
            }
        }

        return $output;
    }

    /**
     * Compiles $_POST
     */
    protected function _compile_post()
    {
        $output = array();

        if (0 == count($this->post))
        {
            $output = 'Il n\'y a pas de variable $_POST.';
        }
        else
        {
            foreach ($this->post as $key => $val)
            {
                if ( ! is_numeric($key))
                {
                    $key = "'".$key."'";
                }

                if (is_array($val))
                {
                    $output['&#36;_POST['. $key .']'] = '<pre>'. htmlspecialchars(stripslashes(print_r($val, TRUE))) . '</pre>';
                }
                else
                {
                    $output['&#36;_POST['. $key .']'] = htmlspecialchars(stripslashes($val));
                }
            }
        }

        return $output;
    }

    /**
     * Compiles included files
     */
    protected function _compile_files()
    {
        if (0 == count($this->files))
        {
            $this->files = 'Il n\'y a pas de fichiers chargés.';
        }
        else
        {
            sort($this->files);
        }

        return $this->files;
    }

    /**
     * Compiles $_SESSION
     */
    protected function _compile_session()
    {
        $output = array();

        if (0 == count($this->session))
        {
            $output = 'Il n\'y a pas de variable $_SESSION';
        } else {
            foreach ($this->session as $key => $val)
            {
                if (is_numeric($key))
                {
                    $output[$key] = "'$val'";
                }

                if (is_array($val))
                {
                    $output[$key] = htmlspecialchars(stripslashes(print_r($val, true)));
                }
                else
                {
                    $output[$key] = htmlspecialchars(stripslashes($val));
                }
            }
        }

        return $output;
    }

    /**
     * Compiles queries
     */
    protected function _compile_queries()
    {
        $output = array();

        if (count($this->queries) == 0)
        {
            $output = 'Il n\'y a pas de requête exécutée.';
        }
        else
        {
            foreach ($this->queries as $key => $val)
            {
                $time = number_format($val['time'], 4);

                $output[$time] = $val['query'];
            }
        }

        return $output;
    }
}